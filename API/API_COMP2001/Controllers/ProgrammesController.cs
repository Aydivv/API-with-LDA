using System;
using System.Collections.Generic;
using System.Linq;
using System.Threading.Tasks;
using Microsoft.AspNetCore.Http;
using Microsoft.AspNetCore.Mvc;
using API_COMP2001.Models;
using Microsoft.EntityFrameworkCore;

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

        //Delete Programme
        [HttpDelete("{code}")]
        public IActionResult Delete(int code)
        {
            _database.Delete(code);
            return NoContent();
        }
    }
}
