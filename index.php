<?

if (isset($_POST['form'])) {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $tel = $_POST['tel'];
    $data = ['name' => "$name", 'email' => "$email", 'tel' => "$tel"];
    $errors = validateForm($data);
    

    if (empty($errors)) {
        echo '<script>document.location.href="/"; alert("Форма успешно отправлена")</script>';
    }
}

function validateForm($data)
{
    $errors = [];

    if (empty($data['name'])) {
        $errors[] = 'Поле "Имя" не может быть пустым';
    } elseif (strlen($data['name']) > 50) {
        $errors[] = 'Длина имени должна быть меньше 50 символов';
    }

    if (empty($data['email'])) {
        $errors[] = 'Поле "Email" не может быть пустым';
    } elseif (!filter_var($data['email'], FILTER_VALIDATE_EMAIL)) {
        $errors[] = 'Некорректный адрес электронной почты';
    }

    if (empty($data['tel'])) {
        $errors[] = 'Поле "Номер телефона" не может быть пустым';
    } elseif (strlen($data['tel']) != 10) {
        $errors[] = 'Номер телефона должен содержать ровно 10 цифр';
    }

    return $errors;
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="autor" content="MaslovLev425VEB">
    <title>Sm2</title>
    <link rel="stylesheet" href="./assets/css/style.css">
</head>

<body>
    <form method="post" name="newform">
        <div class="text-input">
            <label for="name">Имя</label>
            <input type="text" name="name" placeholder="Имя" value="<? if (isset($_POST['form'])) echo $name ?>">
        </div>
        <div class="text-input">
            <label for="email">E-mail</label>
            <input type="text" name="email" placeholder="E-mail" value="<? if (isset($_POST['form'])) echo $email ?>">
        </div>
        <div class="text-input">
            <label for="tel">Номер телефона</label>
            <input type="text" name="tel" placeholder="Номер телефона" value="<? if (isset($_POST['form'])) echo $tel ?>">
        </div>
        <p class="errors"><? if (isset($_POST['form'])) {
                                echo $errors[0];
                            } ?></p>
        <input type="submit" class="btn" value="Отправить" name="form">
    </form>
</body>

</html>