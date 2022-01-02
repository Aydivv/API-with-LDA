using System;
using System.Collections.Generic;
using System.Data;
using System.Linq;
using System.Data.SqlClient;
using System.Threading.Tasks;
using Microsoft.Extensions.Configuration;
using Microsoft.EntityFrameworkCore;
using API_COMP2001.Helpers;

namespace API_COMP2001.Models
{
    public class DataAccess : DbContext
    {
        private readonly string connect;
        public DbSet<Programme> Programmes { get; set; }

        public DataAccess(DbContextOptions<DataAccess> options) : base(options)
        {
            connect = Database.GetConnectionString();
        }

        protected override void OnModelCreating(ModelBuilder modelBuilder)
        {
            modelBuilder.Entity<Programme>(entity =>
            {
                entity.ToTable("Programmes", "CW2");

                entity.Property(e => e.Code)
                .ValueGeneratedNever()
                .HasColumnName("programmeCode");

                entity.HasKey(e => e.Code)
                .HasName("PK__Programm__2314009A93F66A43");
            });
        }

        public void Create(Programme prm)
        {
            using (SqlConnection sql = new SqlConnection(connect))
            {
                using (SqlCommand cmd = new SqlCommand("CW2.Create_Programme", sql))
                {
                    cmd.CommandType = CommandType.StoredProcedure;
                    cmd.Parameters.Add(new SqlParameter("@Programme_Code", prm.Code));
                    cmd.Parameters.Add(new SqlParameter("@Title", string.IsNullOrEmpty(prm.Title) ? (object)DBNull.Value : prm.Title));
                    SqlParameter output = new SqlParameter("@ResponseMessage", SqlDbType.VarChar, 250);
                    output.Direction = ParameterDirection.Output;
                    cmd.Parameters.Add(output);
                    sql.Open();

                    string sqlresponse;

                    cmd.ExecuteNonQuery();
                    sqlresponse = output.Value.ToString();

                    if (String.Equals(sqlresponse,"208"))
                        throw new ProgrammeExistException("Call successful, but Programme already exists and so new entry not made.");
                    else if (String.Equals(sqlresponse, "404"))
                        throw new TableNotFoundException("Table not found.");
                }
            }
        }

        public void Update(Programme prm, int Code)
        {
            using (SqlConnection sql = new SqlConnection(connect))
            {
                using (SqlCommand cmd = new SqlCommand("CW2.Update_Programme", sql))
                {
                    cmd.CommandType = CommandType.StoredProcedure;
                    cmd.Parameters.Add(new SqlParameter("@Programme_Code", Code));
                    cmd.Parameters.Add(new SqlParameter("@Title", prm.Title));
                    sql.Open();

                    try
                    {
                        cmd.ExecuteNonQuery();
                    }
                    catch (Exception e)
                    {
                        throw new ProgrammeNotFoundException("Programme does not exist.");
                    }
                }
            }
        }


        public void Delete(int Code)
        {
            using (SqlConnection sql = new SqlConnection(connect))
            {
                using (SqlCommand cmd = new SqlCommand("CW2.Delete_Programme", sql))
                {
                    cmd.CommandType = CommandType.StoredProcedure;
                    cmd.Parameters.Add(new SqlParameter("@Programme_Code", Code));

                    sql.Open();

                    try
                    {
                        cmd.ExecuteNonQuery();
                    }
                    catch (Exception e)
                    {
                        throw new ProgrammeNotFoundException("Programme does not exist.");
                    }
                }
            }
        }
    }
}
