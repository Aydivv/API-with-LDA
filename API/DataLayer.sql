/*Creating tables and data structure*/

CREATE SCHEMA CW2;

CREATE TABLE cw2.Students (
  studentID INT IDENTITY(1,1) PRIMARY KEY,
  name VARCHAR(100) NOT NULL
);

CREATE TABLE cw2.Programmes (
  programmeCode INT PRIMARY KEY,
  title varchar(100) NOT NULL
);

CREATE TABLE cw2.Projects (
  projectID INT IDENTITY(1,1) PRIMARY KEY,
  title VARCHAR(100) NOT NULL,
  [description] VARCHAR(255) NOT NULL,
  [year] int NOT NULL,
  thumbnail VARBINARY(MAX),
  poster VARBINARY(MAX)
);

CREATE TABLE cw2.StudentProject (
  studentID INT FOREIGN KEY REFERENCES cw2.Students (studentID),
  projectID INT FOREIGN KEY REFERENCES cw2.Projects (projectID),
  PRIMARY KEY (studentID,projectID)
);

CREATE TABLE cw2.StudentProgramme (
  studentID INT FOREIGN KEY REFERENCES cw2.Students (studentID),
  programmeCode INT FOREIGN KEY REFERENCES cw2.Programmes (programmeCode),
  currentStudent BIT NOT NULL,
  PRIMARY KEY (studentID,programmeCode)
);

CREATE TABLE cw2.auditProgrammes (
  programmeCode INT NOT NULL,
  title VARCHAR(100) NOT NULL,
  [time of update] VARCHAR(100) NOT NULL,
);

/*Inserting Dummy Data*/

INSERT INTO CW2.Students VALUES
('Suryansh'),
('Khushi'),
('Arnav');

INSERT INTO CW2.Programmes VALUES
(100,'Bachelors in Computer Science'),
(200,'Bachelors in Psychology'),
(300,'Bachelors in Finance');

INSERT INTO CW2.Projects VALUES
('jay getting cught','rrrrrrrr sumn',2021,010000101010101001,01101),
('big one','massivieeeee',2020,01101,110111),
('12w12w12w','lolastata',2021,0110,0011101);

INSERT INTO CW2.StudentProject VALUES
(1,1),
(2,1),
(2,2),
(3,3);

INSERT INTO CW2.StudentProgramme VALUES
(1,200,1),
(2,200,1),
(3,300,1);

/*Print dummy data*/

select * from cw2.Students  
select * from cw2.Programmes
select * from cw2.Projects
select * from cw2.StudentProgramme
select * from cw2.StudentProject
SELECT * FROM CW2.auditProgrammes
select * from cw2.sProgrammes

/*Create Procedures */

CREATE PROCEDURE CW2.Update_Programme(@Programme_Code AS INT,@Title AS VARCHAR(100))
AS
BEGIN 
    BEGIN TRANSACTION
        DECLARE @Error NVARCHAR(MAX);
        BEGIN TRY    
            IF (EXISTS (SELECT * FROM INFORMATION_SCHEMA.TABLES
                WHERE TABLE_SCHEMA = 'CW2'
                AND TABLE_NAME = 'Programmes'))
            BEGIN
                IF @Programme_Code IN (SELECT programmeCode FROM CW2.Programmes WHERE programmeCode = @Programme_Code)
                BEGIN
                    UPDATE CW2.Programmes SET title = @Title WHERE programmeCode = @Programme_Code;
                    COMMIT
                END
                ELSE
                BEGIN
                    SET @Error = 'Programme does not exist';
                    RAISERROR(@Error,16,1);
                END
            END
            ELSE
                BEGIN
                    SET @Error = 'Table does not exist';
                    RAISERROR(@Error,16,1);
                END;
        END TRY
        BEGIN CATCH
            PRINT 'An error has occurred.'
            ROLLBACK
            RAISERROR(@Error,1,1);
        END CATCH
    END


CREATE PROCEDURE CW2.Delete_Programme(@Programme_Code AS INT)
AS
BEGIN 
    BEGIN TRANSACTION
        DECLARE @Error NVARCHAR(MAX);
        BEGIN TRY    
            IF (EXISTS (SELECT * FROM INFORMATION_SCHEMA.TABLES
                wHERE TABLE_SCHEMA = 'CW2'
                AND TABLE_NAME = 'Programmes'))
            BEGIN
                IF @Programme_Code IN (SELECT programmeCode FROM CW2.Programmes WHERE programmeCode = @Programme_Code)
                BEGIN
                    DELETE FROM CW2.StudentProgramme WHERE programmeCode = @Programme_Code;
                    DELETE FROM CW2.Programmes WHERE programmeCode = @Programme_Code;
                    COMMIT
                END
                ELSE
                BEGIN
                    SET @Error = 'Programme does not exist';
                    RAISERROR(@Error,16,1);
                END
            END
            ELSE
                BEGIN
                    SET @Error = 'Table does not exist';
                    RAISERROR(@Error,16,1);
                END;
        END TRY
        BEGIN CATCH
            PRINT 'An error has occurred.'
            ROLLBACK
            RAISERROR(@Error,1,1);
        END CATCH
    END

CREATE PROCEDURE CW2.Create_Programme(@Programme_Code INT,@Title VARCHAR(250),@ResponseMessage VARCHAR(250) OUT)
AS
BEGIN 
    BEGIN TRANSACTION
        DECLARE @Error NVARCHAR(MAX);
        BEGIN TRY    
            IF (EXISTS (SELECT * FROM INFORMATION_SCHEMA.TABLES
                wHERE TABLE_SCHEMA = 'CW2'
                AND TABLE_NAME = 'Programmes'))
            BEGIN
                IF @Programme_Code IN (SELECT programmeCode FROM CW2.Programmes WHERE programmeCode = @Programme_Code)
                BEGIN
                    PRINT 'Programme already exists.'
                    SET @ResponseMessage = '208'
                    COMMIT
                END
                ELSE
                BEGIN
                    INSERT INTO CW2.Programmes VALUES (@Programme_Code,@Title);
                    SET @ResponseMessage = '201'
                    COMMIT
                END
            END
            ELSE
                BEGIN
                    SET @Error = 'Table does not exist';
                    SET @ResponseMessage = '404';
                    RAISERROR(@Error,16,1);
                END;
        END TRY
        BEGIN CATCH
            PRINT 'An error has occurred.'
            ROLLBACK
            RAISERROR(@Error,1,1);
        END CATCH
    END


/* Trigger */

CREATE TRIGGER CW2.Audit_Programme ON CW2.Programmes
AFTER UPDATE
AS 
BEGIN
    BEGIN TRANSACTION
        BEGIN TRY
            DECLARE @deletedCode INT;
            DECLARE @deletedTitle VARCHAR(100);
            SELECT @deletedCode = programmeCode from deleted;
            SELECT @deletedTitle = Title from deleted;
            INSERT INTO CW2.auditProgrammes VALUES (@deletedCode,@deletedTitle,SYSDATETIME());
            COMMIT;
        END TRY
        BEGIN CATCH
            PRINT 'An error has occurred.'
            ROLLBACK
            RAISERROR(@Error,1,1);
        END CATCH
    END
END



/* View */

CREATE VIEW CW2.sProgrammes ([Student ID],[Student Name],[Programme Title],[Programme Code])
AS
SELECT SP.studentID,S.name,P.title,SP.programmeCode FROM 
CW2.StudentProgramme AS SP,CW2.Students AS S, CW2.Programmes AS P
WHERE SP.studentID = S.studentID and SP.programmeCode = P.programmeCode




/* Student in only one programme trigger */
CREATE TRIGGER CW2.checkCurrentStudent ON CW2.StudentProgramme
AFTER INSERT
AS 
BEGIN
    IF (SELECT COUNT(*) FROM CW2.StudentProgramme SP,inserted I WHERE SP.studentID = I.studentID AND SP.currentStudent = 1 ) > 1
    BEGIN 
        DECLARE @iStudentID INT;
        DECLARE @iProgrammeCode INT;
        SELECT @iStudentID = inserted.studentID, @iProgrammeCode = inserted.programmeCode FROM inserted;
        DELETE FROM CW2.StudentProgramme WHERE programmeCode = @iProgrammeCode and studentID = @iStudentID;
        PRINT 'Student already in another programme.'
    END
END
