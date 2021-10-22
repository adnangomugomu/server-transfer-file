<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="server komputer by gomugomu">

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.0.0/css/font-awesome.min.css" integrity="sha512-FEQLazq9ecqLN5T6wWq26hCZf7kPqUbFC9vsHNbXMJtSZZWAcbJspT+/NEAQkBfFReZ8r9QlA9JHaAuo28MTJA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="shortcut icon" href="<?= base_url('assets/') ?>logo.png" type="image/x-icon">

    <title>Server Komputer</title>
    <style>
        table {
            table-layout: fixed;
            word-wrap: break-word;
        }

        .dropzone.dz-clickable {
            border: none !important;
            border-radius: 30px;
        }
    </style>
</head>

<body>

    <div class="container">
        <div class="jumbotron jumbotron-fluid">
            <div class="container">
                <h1 class="display-4">Server Komputer By Gomugomu</h1>
                <p class="lead">mudah, ringkas, cepat</p>
            </div>
        </div>

        <div class="row">

            <div class="col-md-12 mb-4">
                <div class="card border border-primary">
                    <div class="card-body bg-primary">
                        <div class="card-title">
                            <h4 class="text-white">Upload file</h4>
                        </div>
                    </div>
                    <div style="min-height: 75px;" class="dropzone dz-clickable" id="dropzone_me">
                        <div class="dz-default dz-message" data-dz-message="">
                            <span>drag here</span>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-12 mb-4">
                <div class="card">
                    <div class="card-body">
                        <div class="card-title">
                            <h4>List Data</h4>
                        </div>
                        <div class="table-responsive">
                            <table id="table_data" style="width: 100%;" class="table table-bordered table-striped text-center">
                                <thead class="bg-dark text-white">
                                    <tr>
                                        <th class="text-center">File</th>
                                        <th class="text-center">Size</th>
                                        <th class="text-center">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>

    <?php include('index_js.php'); ?>
</body>

</html>