<main>
    <h1>Users:</h1>
    <style>
        table {
            max-width: 550px;
            border: 1px solid #ccc;
            padding: 5px;
            margin-bottom: 25px;
        }

        td,
        th {
            text-align: start;
            padding: 3px;
        }
    </style>
    <table class="table">
        <thead>
            <tr>
                <th scope="col">ID</th>
                <th scope="col">Nombre</th>
                <th scope="col">email</th>
                <th scope="col">Aciones</th>
            </tr>
        </thead>
        <tbody>

            <?php foreach ($data['results'] as $result): ?>
                <tr class="">
                    <td scope="row"><?= $result->id ?></td>
                    <td><?= $result->name ?></td>
                    <td><?= $result->email ?></td>
                    <td>
                        <a class=" m-3" href="http://localhost/public_html/framework-v1/user/delete?d=<?= $result->id ?>">
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

    <table class="table">
        <thead>
            <tr>
                <th scope="col">ID</th>
                <th scope="col">Nombre</th>
                <th scope="col">email</th>
                <th scope="col">Aciones</th>
            </tr>
        </thead>
        <tbody>

            <tr class="">
                <td scope="row"><?= $data['oneresult']->id ?? '1' ?></td>
                <td><?= $data['oneresult']->name ?? 'john' ?></td>
                <td><?= $data['oneresult']->email ?? 'johndoe12345@mail.com' ?></td>
                <td>
                    <a href="http://localhost/public_html/framework-v1/user/delete?d=<?= $data['oneresult']->id ?? '1' ?>">
                        <i class="bi bi-trash3"></i>
                    </a>
                    <a href="http://localhost/public_html/framework-v1/user/update?user_id=<?= $data['oneresult']->id ?? '1' ?>">
                        <i class="bi bi-pencil-square"></i>
                    </a>
                </td>
            </tr>

        </tbody>
    </table>
</main>

