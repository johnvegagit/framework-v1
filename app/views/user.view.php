<nav class="nav justify-content-start">
    <a class="nav-link active" href="http://localhost/public_html/framework-v1/user">user home</a>
</nav>

<main class="container-fluid p-3 d-flex justify-content-between ">
    <form class="col-sm-4 p-3" action="http://localhost/public_html/framework-v1/user/insert" method="post">
        <div class="mb-3">
            <label for="name" class="form-label">Nombre*</label>
            <input type="text" class="form-control" name="name" placeholder="Escriba un nombre...">
        </div>
        <div class="mb-3">
            <label for="age" class="form-label">Edad</label>
            <input type="text" class="form-control" name="age" placeholder="Escriba una edad...">
        </div>
        <button type="submit" class="btn btn-primary">Insertar usuario</button>
    </form>

    <div class="table-responsive col-sm-8 border">
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">ID</th>
                    <th scope="col">Nombre</th>
                    <th scope="col">Edad</th>
                    <th scope="col">Fecha</th>
                    <th scope="col">Aciones</th>
                </tr>
            </thead>
            <tbody>

                <?php foreach ($data['results'] as $result): ?>
                    <tr class="">
                        <td scope="row"><?= $result->id ?></td>
                        <td><?= $result->name ?></td>
                        <td><?= $result->age ?></td>
                        <td><?= $result->date ?></td>
                        <td>
                            <a class=" m-3"
                                href="http://localhost/public_html/framework-v1/user/delete?d=<?= $result->id ?>">
                                <i class="bi bi-trash3"></i>
                            </a>
                            <a href="http://localhost/public_html/framework-v1/user/update?user_id=<?= $result->id ?>">
                                <i class="bi bi-pencil-square"></i>
                            </a>
                        </td>
                    </tr>
                <?php endforeach; ?>

            </tbody>
        </table>
    </div>

</main>