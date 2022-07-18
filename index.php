<?php session_start();?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2" crossorigin="anonymous"></script>
    <title>Title</title>
</head>
<body class="bg-dark">
<header>
    <div class="px-5 py-2 bg-secondary text-white">
        <ul class="nav justify-content-end">
            <div class="py-2 flex-grow-1 bd-highlight">
                <p class="fs-5 text">
                    <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" fill="currentColor" class="bi bi-book mx-1 py-1" viewBox="0 0 16 16">
                        <path d="M1 2.828c.885-.37 2.154-.769 3.388-.893 1.33-.134 2.458.063 3.112.752v9.746c-.935-.53-2.12-.603-3.213-.493-1.18.12-2.37.461-3.287.811V2.828zm7.5-.141c.654-.689 1.782-.886 3.112-.752 1.234.124 2.503.523 3.388.893v9.923c-.918-.35-2.107-.692-3.287-.81-1.094-.111-2.278-.039-3.213.492V2.687zM8 1.783C7.015.936 5.587.81 4.287.94c-1.514.153-3.042.672-3.994 1.105A.5.5 0 0 0 0 2.5v11a.5.5 0 0 0 .707.455c.882-.4 2.303-.881 3.68-1.02 1.409-.142 2.59.087 3.223.877a.5.5 0 0 0 .78 0c.633-.79 1.814-1.019 3.222-.877 1.378.139 2.8.62 3.681 1.02A.5.5 0 0 0 16 13.5v-11a.5.5 0 0 0-.293-.455c-.952-.433-2.48-.952-3.994-1.105C10.413.809 8.985.936 8 1.783z"/>
                    </svg>book tasks
                </p>
            </div>
            <?php
                if(isset($_SESSION['task_create_success'])) {
                    if ($_SESSION['task_create_success']) {
                        echo '<div class="alert alert-success" role="alert">
                            the task has been created
                        </div>';
                        $_SESSION['task_create_success'] = null;
                    } elseif (!$_SESSION['task_create_success']) {
                        echo '<div class="alert alert-danger " role="alert">
                            the task is not created
                      </div>';
                        $_SESSION['task_create_success'] = null;
                    }
                }
            ?>
            <div class="dropdown px-2 py-2">
                <a class="btn btn-outline-light dropdown-toggle" role="button" id="dropdownMenuLink" data-bs-toggle="dropdown" aria-expanded="false"   >
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-alarm" viewBox="0 0 16 16">
                        <path d="M8.5 5.5a.5.5 0 0 0-1 0v3.362l-1.429 2.38a.5.5 0 1 0 .858.515l1.5-2.5A.5.5 0 0 0 8.5 9V5.5z"/>
                        <path d="M6.5 0a.5.5 0 0 0 0 1H7v1.07a7.001 7.001 0 0 0-3.273 12.474l-.602.602a.5.5 0 0 0 .707.708l.746-.746A6.97 6.97 0 0 0 8 16a6.97 6.97 0 0 0 3.422-.892l.746.746a.5.5 0 0 0 .707-.708l-.601-.602A7.001 7.001 0 0 0 9 2.07V1h.5a.5.5 0 0 0 0-1h-3zm1.038 3.018a6.093 6.093 0 0 1 .924 0 6 6 0 1 1-.924 0zM0 3.5c0 .753.333 1.429.86 1.887A8.035 8.035 0 0 1 4.387 1.86 2.5 2.5 0 0 0 0 3.5zM13.5 1c-.753 0-1.429.333-1.887.86a8.035 8.035 0 0 1 3.527 3.527A2.5 2.5 0 0 0 13.5 1z"/>
                    </svg>
                    Create Task
                </a>
                <ul class="dropdown-menu bg-dark text-white"  aria-labelledby="dropdownMenuLink">
                    <form class="mx-2" action="record.php" method="post" enctype="multipart/form-data">
                            <input type="email" name="email" class="form-control my-1" aria-describedby="emailHelp" placeholder="Enter email" required>
                            <input type="text" name="username" class="form-control my-1" placeholder="Enter username" required>
                            <textarea class="form-control" name="task" id="exampleFormControlTextarea1" rows="3" placeholder="Enter task" required></textarea>
                        <div class="d-flex justify-content-center my-1">
                            <button type="submit" name="createTask"  class="btn btn-outline-light"> Submit</button>
                        </div>
                    </form>
                </ul>
            </div>
            <div class="dropdown py-2">
                <a class="btn btn-outline-light dropdown-toggle" role="button" id="dropdownMenuLink" data-bs-toggle="dropdown" aria-expanded="false"   >
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-person-circle" viewBox="0 0 16 16">
                        <path d="M11 6a3 3 0 1 1-6 0 3 3 0 0 1 6 0z"/>
                        <path fill-rule="evenodd" d="M0 8a8 8 0 1 1 16 0A8 8 0 0 1 0 8zm8-7a7 7 0 0 0-5.468 11.37C3.242 11.226 4.805 10 8 10s4.757 1.225 5.468 2.37A7 7 0 0 0 8 1z"/>
                    </svg>
                    For Admin
                </a>
                <ul class="dropdown-menu bg-dark text-white"  aria-labelledby="dropdownMenuLink">
                    <form class="mx-2" action="record.php" method="post" enctype="multipart/form-data">
                        <?php
                            if($_SESSION['admin_mode'] == 0) {
                                echo ('<input type="text" name="admin_login" class="form-control my-1" aria-describedby="emailHelp" placeholder="Enter login" required>
                                    <input type="password" name="admin_password" class="form-control my-1" placeholder="Enter password" required>
                                    <div class="d-flex justify-content-center my-1">
                                        <button type="submit" name="forAdmin" class="btn btn-outline-light">Submit</button>
                                    </div>');
                                }
                            else{
                               echo'<div class="d-flex justify-content-center my-1"> 
                                        <button type="submit" name="forAdmin_exit" class="btn btn-outline-light">Exit</button>
                                   </div>';
                            }
                        ?>

                    </form>
                </ul>
            </div>
        </ul>
    </div>
</header>
<div class="container py-5">
    <form class="row bg-secondary pt-4 px-4" method="post" action="record.php">
        <div class="col pt-1">
            <input type="text" class="form-control" placeholder="Username" value="<?php echo($_SESSION['username'])?>" name="username" aria-label="First name">
        </div>
        <div class="col pt-1">
            <input type="text" class="form-control" placeholder="Email" name="email" value="<?php echo($_SESSION['email'])?>" aria-label="Last name">
        </div>

        <div class="col-1 text-white pt-2">
            <label>admin</label>
            <label>edit</label>
        </div>
        <div class="col-1 pt-1">
            <select class="form-select" name="admin_edit">
                <option value="2"<?php if($_SESSION['admin_edit'] == 2) echo 'selected'?>>...</option>
                <option value="1"<?php if($_SESSION['admin_edit'] == 1) echo 'selected'?>>Yes</option>
                <option value="0"<?php if($_SESSION['admin_edit'] == 0) echo 'selected'?>>No</option>
            </select>
        </div>
        <div class="col-1 text-white pt-2">
            <label>completed</label>
        </div>
        <div class="col-1 pt-1">
            <select class="form-select" name="completed">
                <option value="2" <?php if($_SESSION['completed'] == 2) echo 'selected'?>>...</option>
                <option value="1" <?php if($_SESSION['completed'] == 1) echo 'selected'?>>Yes</option>
                <option value="0" <?php if($_SESSION['completed'] == 0) echo 'selected'?>>No</option>
            </select>
        </div>
        <div class="col-1">
            <button type="submit" class="btn btn-secondary" name="sort">
                <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" fill="currentColor" class="bi bi-arrow-right-square-fill" viewBox="0 0 16 16">
                    <path d="M0 14a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2H2a2 2 0 0 0-2 2v12zm4.5-6.5h5.793L8.146 5.354a.5.5 0 1 1 .708-.708l3 3a.5.5 0 0 1 0 .708l-3 3a.5.5 0 0 1-.708-.708L10.293 8.5H4.5a.5.5 0 0 1 0-1z"/>
                </svg>
            </button>
        </div>
    </form>
    <div class="row justify-content-center bg-secondary">
        <div class="text-white px-5 ">
            <?php
            include 'function.php';
            outputTasks($_GET['page'],$_SESSION['username'],$_SESSION['email'],$_SESSION['admin_edit'],$_SESSION['completed']);
            ?>
            <form class="row justify-content-md-center pb-2" action="record.php" method="post">
                <label class="col-1 px-5 pt-2">Page: </label>
                    <div class="col-1">
                    <input type="number" name="page_input" min="0" max = "<?php echo(getCountPage());?>" value="<?php if(isset($_GET['page'])){echo($_GET['page']);}else{echo '0';} ?>" class="form-control">
                    </div>
                    <div class="col-1">
                        <button type="submit" class="btn btn-secondary">
                            <svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" fill="currentColor" class="bi bi-arrow-right-square-fill" viewBox="0 0 16 16">
                                <path d="M0 14a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2H2a2 2 0 0 0-2 2v12zm4.5-6.5h5.793L8.146 5.354a.5.5 0 1 1 .708-.708l3 3a.5.5 0 0 1 0 .708l-3 3a.5.5 0 0 1-.708-.708L10.293 8.5H4.5a.5.5 0 0 1 0-1z"/>
                            </svg>
                        </button>
                    </div>
            </form>
        </div>
    </div>

</div>
</body>
</html>