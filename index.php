<?php
require 'processor.php';
?>


<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
  <meta name="generator" content="Jekyll v4.0.1">
  <title>TODO RESTAPI</title>


  <!-- Bootstrap core CSS -->
  <link href="dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">

  <!-- Favicons -->
  <link rel="apple-touch-icon" href="assets/img/favicons/apple-touch-icon.png" sizes="180x180">
  <link rel="icon" href="assets/img/favicons/favicon-32x32.png" sizes="32x32" type="image/png">
  <link rel="icon" href="assets/img/favicons/favicon-16x16.png" sizes="16x16" type="image/png">
  <link rel="manifest" href="assets/img/favicons/manifest.json">
  <link rel="mask-icon" href="assets/img/favicons/safari-pinned-tab.svg" color="#563d7c">
  <link rel="icon" href="assets/img/favicons/favicon.ico">
  <meta name="msapplication-config" content="assets/img/favicons/browserconfig.xml">
  <meta name="theme-color" content="#563d7c">


  <style>
    .bd-placeholder-img {
      font-size: 1.125rem;
      text-anchor: middle;
      -webkit-user-select: none;
      -moz-user-select: none;
      -ms-user-select: none;
      user-select: none;
    }

    @media (min-width: 768px) {
      .bd-placeholder-img-lg {
        font-size: 3.5rem;
      }
    }

    /* Move down content because we have a fixed navbar that is 3.5rem tall */
    body {
      padding-top: 3.5rem;
    }
  </style>
  <!-- Custom styles for this template -->
  <link href="jumbotron.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>

</head>

<body>
  <nav class="navbar navbar-expand-md navbar-dark fixed-top bg-dark">
    <a class="navbar-brand" href="#">This is My Awesome Blog</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsExampleDefault" aria-controls="navbarsExampleDefault" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>


  </nav>

  <main role="main">

    <!-- Main jumbotron for a primary marketing message or call to action -->
    <div class="jumbotron">
      <div class="container">
        <h1 class="display-3">Hello, world!</h1>
        <p>This is a template for a simple marketing or informational website. It includes a large callout called a jumbotron and three supporting pieces of content. Use it as a starting point to create something more unique.</p>
        <p><a class="btn btn-primary btn-lg" href="#" data-toggle="modal" data-target="#exampleModal" data-type="create" role="button">Create New Todo</a></p>
      </div>
    </div>

    <div class="container">
      <!-- Example row of columns -->

      <?php if (isset($_GET['status'])) { ?>
        <div class="row">
          <div class="col-12">
            <?php if ($_GET['status'] == 'success') { ?>
              <script>
                Swal.fire({
                  title: 'Successful!',
                  text: 'Its all good!',
                  icon: 'success',
                  confirmButtonText: 'Cool'
                })
              </script>
            <?php }
            if ($_GET['status'] == 'fail') { ?>
              <script>
                Swal.fire({
                  title: 'Error!',
                  text: 'Something has throwing error',
                  icon: 'error',
                  confirmButtonText: 'Cool'
                })
              </script>
            <?php } ?>
          </div>
        </div>
      <?php } ?>
      <div class="row">
        <?php foreach ($result as $data) { ?>
          <div class="col-md-4 mb-3">
            <h4><?= $data->title ?></h4>
            <p><?= $data->body ?></p>
            <small><span class="badge badge-secondary"><?= $data->created_at ?></span></small>
            <p class="d-flex justify-content-end">
              <button class="btn btn-sm  btn-info" data-toggle="modal" data-target="#exampleModal" data-title="<?= $data->title ?>" data-body="<?= $data->body ?>" data-id="<?= $data->id ?>" data-type="edit" role="button">Edit</button>&nbsp;
              <a class="btn btn-sm btn-danger" href="process.php?id=<?= $data->id ?>" role="button">Delete</a>&nbsp;
            </p>
          </div>
        <?php } ?>
      </div>


    </div> <!-- /container -->

  </main>

  <!-- modal -->

  <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <form action="processor.php" method="POST">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">New Todo</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <div class="form-group">
              <label for="title" class="col-form-label">Title</label>
              <input type="text" class="form-control" name="title" id="title">
            </div>
            <div class="form-group">
              <label for="body" class="col-form-label">Body</label>
              <textarea class="form-control" name="body" id="body"></textarea>
            </div>
            <input type="hidden" name="method" id="method" value="create">
            <input type="hidden" name="todo_id" id="todo-id">
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary">Submit</button>
          </div>
        </form>
      </div>
    </div>
  </div>

  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
  <script>
    window.jQuery || document.write('<script src="assets/js/vendor/jquery.slim.min.js"><\/script>')
  </script>
  <script src="dist/js/bootstrap.bundle.min.js" integrity="sha384-1CmrxMRARb6aLqgBO7yyAxTOQE2AKb9GfXnEo760AUcUmFx3ibVJJAzGytlQcNXd" crossorigin="anonymous"></script>

  <script>
    $('#exampleModal').on('show.bs.modal', function(event) {
      var button = $(event.relatedTarget) // Button that triggered the modal
      var title = button.data('title') // Extract info from data-* attributes
      var body = button.data('body') // Extract info from data-* attributes
      var type = button.data('type') // Extract info from data-* attributes
      var id = button.data('id') // Extract info from data-* attributes
      var modal = $(this)
      modal.find('.modal-title').text('Edit Todo ')
      modal.find('#title').val(title)
      modal.find('#body').val(body)
      modal.find('#method').val(type)
      modal.find('#todo-id').val(id)
    })
  </script>
</body>

</html>