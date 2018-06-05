using System;
using System.Collections.Generic;
using System.Data;
using System.Data.Entity;
using System.Linq;
using System.Net;
using System.Web;
using System.Web.Mvc;
using Tasks.Models;

namespace Tasks.Controllers
{
    public class TasksController : Controller
    {
        private ContextClass db = new ContextClass();

        // GET: Tasks
        public ActionResult Index()
        {
            return View();
        }

        public PartialViewResult TaskList()
        {
            return PartialView("_TaskList", db.Tasks.ToList().OrderBy(t => t.Duedate));
        }

        public PartialViewResult Create()
        {
            return PartialView("_Create");
        }

        [HttpPost]
        [ValidateAntiForgeryToken]
        public ActionResult Create([Bind(Include = "Id,Title,Description,Duedate")] Task task)
        {
            db.Tasks.Add(task);
            db.SaveChanges();
            return PartialView("_TaskList", db.Tasks.ToList().OrderBy(t => t.Duedate));
        }

        public PartialViewResult Edit(int? id)
        {
            Task task = db.Tasks.Find(id);
            return PartialView("_Edit", task);
        }

        [HttpPost]
        [ValidateAntiForgeryToken]
        public ActionResult Edit([Bind(Include = "Id,Title,Description,Duedate")] Task task)
        {
            db.Entry(task).State = EntityState.Modified;
            db.SaveChanges();
            return PartialView("_TaskList", db.Tasks.ToList().OrderBy(t => t.Duedate));
        }

        public PartialViewResult Delete(int? id)
        {
            Task task = db.Tasks.Find(id);
            return PartialView("_Delete", task);
        }

        [HttpPost, ActionName("Delete")]
        [ValidateAntiForgeryToken]
        public ActionResult DeleteConfirmed(int id)
        {
            Task task = db.Tasks.Find(id);
            db.Tasks.Remove(task);
            db.SaveChanges();
            return PartialView("_TaskList", db.Tasks.ToList().OrderBy(t => t.Duedate));
        }



    }
}
