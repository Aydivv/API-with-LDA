using System;
using System.Collections.Generic;
using System.Linq;
using System.Threading.Tasks;
using Microsoft.AspNetCore.Http;
using Microsoft.AspNetCore.Mvc;
using API_COMP2001.Models;
using Microsoft.EntityFrameworkCore;
using API_COMP2001.Helpers;

namespace API_COMP2001.Controllers
{
    [Route("[controller]")]
    [ApiController]
    public class ProgrammesController : ControllerBase
    {
        private readonly DataAccess _database;

        public ProgrammesController(DataAccess database)
        {
            _database = database;
        }
        //Get Programmes
        [HttpGet]
        public async Task<ActionResult<IEnumerable<Programme>>> GetProgrammes()
        {
            return await _database.Programmes.ToListAsync();
        }

        //Get Programmes Code
        [HttpGet("{code}")]
        public async Task<ActionResult<Programme>> GetProgrammes(int code)
        {
            var _request = await _database.Programmes.FindAsync(code);

            if (_request == null)
            {
                return NotFound();
            }

            return _request;
        }
        //Create Programme
        [HttpPost]
        public IActionResult Post([FromBody] Programme prm)
        {
            try
            {
                _database.Create(prm);
            } catch (ProgrammeExistException e)
            {
                Console.WriteLine(e.StackTrace);
                return StatusCode(208, new { Description = e.Str });
            }
            catch (TableNotFoundException e)
            {
                Console.WriteLine(e.StackTrace);
                return StatusCode(404, new { Description = e.Str });
            }
            return StatusCode(201,new { ProgrammeCode = prm.Code });
        }
        //Update Programme
        [HttpPut("{code}")]
        public IActionResult Put(int code, [FromBody] Programme prm)
        {

            try
            {
                _database.Update(prm, code);
            } catch (ProgrammeNotFoundException e)
            {
                return StatusCode(404, new { Description = e.Str });
            }
            return StatusCode(204, new { Description = "Success" });
        }

        //Delete Programme
        [HttpDelete("{code}")]
        public IActionResult Delete(int code)
        {
            try
            {
                _database.Delete(code);
            }
            catch (ProgrammeNotFoundException e)
            {
                return StatusCode(404, new { Description = e.Str });
            }
            return StatusCode(204, new { Description = "Success" });
        }


        
}
}
