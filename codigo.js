// Validaciones function Required
(function() {
  'use strict';
  window.addEventListener('load', function() {
    // Fetch all the forms we want to apply custom Bootstrap validation styles to
    var forms = document.getElementsByClassName('needs-validation');
    // Loop over them and prevent submission
    var validation = Array.prototype.filter.call(forms, function(form) {
      form.addEventListener('submit', function(event) {
        if (form.checkValidity() === false) {
          event.preventDefault();
          event.stopPropagation();
        }
        form.classList.add('was-validated');
      }, false);
    });
  }, false);
})(); //
// Funciones
$(document).ready(function() {
  // Global Settings
  let edit = false;
  // Testing Jquery
  console.log('jquery is working!');
  fetchTasks();
  $('#task-result').hide();
  // Buscador
  $('#search').keyup(function() {
    if($('#search').val()) {
      let search = $('#search').val();
      $.ajax({
        url: 'task-search.php',
        data: {search},
        type: 'POST',
        success: function (response) {
          if(!response.error) {
            let tasks = JSON.parse(response);
            let template = '';
            tasks.forEach(task => {
              template += `
              <tr  >
              <td  >
              ${task.fuec}
              </td>
              <td>
                ${task.name} 
              </td>
              <td>
                ${task.apellido} 
              </td>
              <td>${task.description}</td>
              </tr>
                    ` 
            });
            $('#task-result').show();
            $('#container').html(template);
          }
        } 
      })
    }
  });
  $('#task-form').submit(e => {
    e.preventDefault();
    const postData = {
      fuec: $('#fuec').val(),
      name: $('#name').val(),
      apellido: $('#apellido').val(),
      description: $('#description').val(),
      contratante: $('#contratante').val(),
      objetocontrato: $('#objetocontrato').val(),
      cc: $('#cc').val(),
      origen: $('#origen').val(),
      recorrido: $('#recorrido').val(),
      activa: $('#activa').val(),
      id: $('#taskId').val()
    };
    const url = edit === false ? 'task-add.php' : 'task-edit.php' ;
    console.log(postData, url);
    $.post(url, postData, (response) => {
      console.log(response);
      $('#task-form').trigger('reset');
      fetchTasks();
    });
  });
  // Fetching Tasks
  function fetchTasks() {
    $.ajax({
      url: 'tasks-list.php',
      type: 'GET',
      success: function(response) {
        const tasks = JSON.parse(response);
        let template = '';
        tasks.forEach(task => {
          template += `
                  <tr taskId="${task.id}">
                  <td>${task.id}</td>
                  <td  >
                  ${task.fuec}
                  </td>
                  <td>
                  <a href="#" class="task-item">
                    ${task.name} 
                  </a>
                  </td>
                  <td>
                  <a href="#" class="task-item">
                    ${task.apellido} 
                  </a>
                  </td>
                  <td>${task.description}</td>
                  <td  >
                  ${task.contratante}
                  </td>
                  <td  >
                  ${task.objetocontrato}
                  </td>
                  <td  >
                  ${task.cc}
                  </td>
                  <td   >
                  ${task.origen}
                  </td>
                  <td >
                  ${task.recorrido}
                  </td>
                  <td>
                    <button class="task-activa btn btn-success-activa ">
                    ${task.activa}
                    </button>
                  </td>
                  <td>
                    <button class="task-delete btn btn-danger">
                     Eliminar 
                    </button>
                  </td>
                  </tr>
                `
        });
        $('#tasks').html(template);
      }
    });
  }
  // Get a Single Task by Id 
  $(document).on('click', '.task-item', (e) => {
    const element = $(this)[0].activeElement.parentElement.parentElement;
    const id = $(element).attr('taskId');
    $.post('task-single.php', {id}, (response) => {
      const task = JSON.parse(response);
      $('#fuec').val(task.fuec);
      $('#name').val(task.name);
      $('#apellido').val(task.apellido);
      $('#description').val(task.description);
      $('#contratante').val(task.contratante);
      $('#objetocontrato').val(task.objetocontrato);
      $('#cc').val(task.cc);
      $('#origen').val(task.origen);
      $('#recorrido').val(task.recorrido);
      $('#taskId').val(task.id);
      edit = true;
    });
    e.preventDefault();
  });
  // Delete a Single Task
  $(document).on('click', '.task-delete', (e) => {
    if(confirm('¿Estás seguro de que quieres eliminarlo?')) {
      const element = $(this)[0].activeElement.parentElement.parentElement;
      const id = $(element).attr('taskId');
      $.post('task-delete.php', {id}, (response) => {
        fetchTasks();
      });
    }
  });

  $(document).on('click', '.task-activa', (e) => {
    if(confirm('¿Estás seguro de que quieres activarlo?')) {
      const element = $(this)[0].activeElement.parentElement.parentElement;
      const id = $(element).attr('taskId');
      $.post('task-activa.php', {id}, (response) => {
        fetchTasks();
      });
    }
  });

});
