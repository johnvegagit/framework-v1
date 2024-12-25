<main>
    <h1>Welcome to Framework-v1</h1>
    <p>A Framework to build your dinamic landinpage web site</p>

    <br>
    <table class="table">
        <thead>
            <tr class="colspan3">
                <th colspan="3" scope="col">Cache testing</th>
            </tr>
            <tr>
                <th scope="col">id</th>
                <th scope="col">name</th>
                <th scope="col">create at</th>
            </tr>
        </thead>
        <?php if (!empty($data['results']) && is_array($data['results'])): ?>
            <tbody>
                <?php foreach ($data['results'] as $result): ?>
                    <tr>
                        <td scope="row"><?= htmlspecialchars($result->id) ?></td>
                        <td scope="row"><?= htmlspecialchars($result->name) ?></td>
                        <td scope="row"><?= htmlspecialchars($result->create_at) ?></td>
                    </tr>
                <?php endforeach ?>
            </tbody>
        <?php else: ?>
            <?php if (!empty($data['results'])): ?>
                <tbody>
                    <tr>
                        <td scope="row"><?= htmlspecialchars($data['results']->id) ?></td>
                        <td scope="row"><?= htmlspecialchars($data['results']->name) ?></td>
                        <td scope="row"><?= htmlspecialchars($data['results']->create_at) ?></td>
                    </tr>
                </tbody>
            <?php else: ?>
                <tbody>
                    <tr>
                        <td scope="row">
                            No data is find whit the id:
                            <?= $_GET['id'] ?>
                        </td>
                    </tr>
                </tbody>
            <?php endif; ?>
        <?php endif; ?>
    </table>
</main>

