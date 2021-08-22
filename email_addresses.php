<?php

require 'includes/init.php';

$conn = require 'includes/db.php';

$address = new SubEmail();

$search = $address->test_input($_GET['search'] ?? '');

$emailButton = $_GET['emails'] ?? '';

$back = $_GET['back'] ?? '';

$emails = $address->filterButton($conn);

if ($search) {
    $addresses = $address->search($conn, $search);
} else {
    $addresses = $address->getAll($conn);
}

if ($emailButton) {
    $addresses = $address->searchEmail($conn, $emailButton);
}

if ($back) {
    Url::redirect('email_addresses.php');
}

if (isset($_GET['sortName'])) {
    $addresses = $address->sort($conn, $emailButton);
}

?>

<?php require_once 'includes/header.php'; ?>


<div id="emailAddress">

    <h2>Email addresses</h2>

    <?php if (empty($addresses)) : ?>
        <p>No email addresses found.</p>
    <?php else : ?>

        <?php if ($emails) : ?>
            <form action="" method="get">
                <div class="filterButtons">
                    <button class="emailButton" type="submit" name="back">back to all emails</button>
                    <?php foreach ($emails as $email) : ?>
                        <button class="emailButton" type="submit" name="emails" value="<?= htmlspecialchars($email['emailDomain']) ?>"><?php echo $email['emailDomain'] ?></button>
                    <?php endforeach; ?>
                </div>
            </form>
        <?php endif; ?>

        <form action="">
            <div class="searchBar">
                <input type="text" class="form-control" placeholder="Search for email" name="search" value="<?= htmlspecialchars($search) ?>">
                <button class="searchBtn" type="submit">Search</button>
            </div>
        </form>
        <form action="">
            <div class="sortButtons">
                <button type="submit" name="sortName">sort by name</button>
                <button type="submit" name="sortDate">sort by date</button>
            </div>
        </form>

        <table class="table">
            <thead>
                <tr>
                    <th>Nr</th>
                    <th>Email address</th>
                    <th>Create Date</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($addresses as $i => $address) : ?>
                    <tr>
                        <th scope="row"><?php echo $i + 1 ?></th>
                        <td><?php echo $address['email'] ?></td>
                        <td><?php echo $address['create_date'] ?></td>
                        <td>
                            <form action="includes/delete.php" method="post">
                                <input type="hidden" name="id" value="<?= htmlspecialchars($address['id']); ?>">
                                <button type="submit" class="delete">Delete</button>
                            </form>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>

    <?php endif; ?>
</div>

</body>

</html>