﻿using System;
using System.Collections.Generic;
using System.Data;
using System.Linq;
using System.Data.SqlClient;
using System.Threading.Tasks;
using Microsoft.Extensions.Configuration;
using Microsoft.EntityFrameworkCore;

namespace API_COMP2001.Models
{
    public class DataAccess : DbContext
    {
        private readonly string _connection;
        public DbSet<Programme> Programmes { get; set; }

        public DataAccess(DbContextOptions<DataAccess> options) : base(options)
        {
            _connection = Database.GetConnectionString();
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

        public void Delete(int Code)
        {
            using (SqlConnection sql = new SqlConnection(_connection))
            {
                using (SqlCommand cmd = new SqlCommand("CW2.Delete_Programme", sql))
                {
                    cmd.CommandType = System.Data.CommandType.StoredProcedure;
                    cmd.Parameters.Add(new SqlParameter("@Programme_Code", Code));

                    sql.Open();

                    cmd.ExecuteNonQuery();
                }
            }
        }
    }
}