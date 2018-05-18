namespace ToDo.Models
{
    using System;
    using System.Collections.Generic;
    using System.ComponentModel.DataAnnotations;

    public partial class task
    {
        public int Id { get; set; }

        [Required(ErrorMessage = "Field Required")]
        public string Item { get; set; }
        public string Description { get; set; }

        [DataType(DataType.Date)]
        public Nullable<System.DateTime> Deadline { get; set; }
    }
}
