using System;
using System.Collections.Generic;
using System.Linq;
using System.Threading.Tasks;

namespace API_COMP2001.Helpers
{
    [Serializable]
    public class ProgrammeExistException : Exception
    {
        public string Str;
        public ProgrammeExistException(string v) {
            this.Str = v;
        }
    }

    [Serializable]
    public class TableNotFoundException : Exception
    {
        public string Str;
        public TableNotFoundException(string v) {
            this.Str = v;
        }
    }

    [Serializable]
    public class ProgrammeNotFoundException : Exception
    {
        public string Str;
        public ProgrammeNotFoundException(string v)
        {
            this.Str = v;
        }
    }
}
