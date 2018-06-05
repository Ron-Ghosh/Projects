namespace Tasks.Models
{
    using System;
    using System.Collections.Generic;
    using System.ComponentModel;
    using System.ComponentModel.DataAnnotations;

    public partial class Task
    {
        public int Id { get; set; }
        public string Title { get; set; }
        public string Description { get; set; }

        [DisplayName("Due Date")]
        [DataType(DataType.Date)]
        public Nullable<System.DateTime> Duedate { get; set; }
    }
}
