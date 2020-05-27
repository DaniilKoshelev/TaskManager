<nav class="navbar navbar-light bg-light">
    <span class="navbar-brand mb-0 h1">TaskManager</span>
    <form class="form-inline">
        <button id="btn-login" type="button" class="btn btn-dark">Login</button>
        <div class="input-group">
            <input id="input-username" type="text" class="form-control" placeholder="Username" aria-describedby="basic-addon1" name="username">
            <div class="input-group-prepend">
                <span class="input-group-text" id="basic-addon1">&nbsp;</span>
            </div>
            <input id="input-password" type="text" class="form-control" placeholder="Password" aria-describedby="basic-addon1" name="password">
        </div>
    </form>
</nav>

<table class="table table-dark">
    <thead>
    <tr>
        <th scope="col">User</th>
        <th scope="col">Email</th>
        <th scope="col">Description</th>
        <th scope="col">Status</th>
        <th scope="col">Tags</th>
    </tr>
    </thead>
    <tbody id="task-table">
    </tbody>
</table>

<div class="pagination-container">
    <ul class="pagination">
        <li class="page-item">
            <a id="page-prev" class="page-link" href="#">
                <span aria-hidden="true">&laquo;</span>
            </a>
        </li>
        <li class="page-item"><a id="page-curr" class="page-link" href="#">1</a></li>
        <li class="page-item">
            <a id="page-next" class="page-link" href="#">
                <span aria-hidden="true">&raquo;</span>
            </a>
        </li>
    </ul>
</div>

<div id="new-task">
    <div class="form-group">
        <label for="exampleInputEmail1">User</label>
        <input id="input-user" class="form-control" aria-describedby="emailHelp" name="user">
    </div>
    <div class="form-group">
        <label for="exampleInputPassword1">Email</label>
        <input id="input-email" type="email" class="form-control" name="email">
    </div>
    <div class="form-group">
        <label for="exampleInputPassword1">Description</label>
        <input id="input-description" class="form-control" name="description">
    </div>
    <button id="btn-submit" class="btn btn-dark" >Add task</button>
</div>