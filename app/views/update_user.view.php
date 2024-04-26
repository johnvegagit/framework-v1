<h1>update user</h1>

<form class="col-sm-4 p-3" action="http://localhost/public_html/framework-v1/user/exc_update" method="post">
    <input type="text" value="<?= $data['user_data']->id ?>" name="id">
    <div class="mb-3">
        <label for="name" class="form-label">Nombre*</label>
        <input type="text" class="form-control" value="<?= $data['user_data']->name ?>" name="name"
            placeholder="Escriba un nombre...">
    </div>
    <div class="mb-3">
        <label for="age" class="form-label">Edad</label>
        <input type="text" class="form-control" value="<?= $data['user_data']->age ?>" name="age"
            placeholder="Escriba una edad...">
    </div>
    <button type="submit" class="btn btn-primary">Insertar usuario</button>
</form>