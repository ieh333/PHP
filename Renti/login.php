<!DOCTYPE html>
<!--
Създаване на форма за вход на регистриран потребител в системата.
-->
<html>
    <head>
        <meta charset="UTF-8">
		<link rel="stylesheet" type="text/css" href="js/jquery-validation-1.14.0/demo/site-demos.css">
        <link rel="stylesheet" type="text/css" href="css/login.css" />
        <title>Форма за вход в системата</title>
    </head>
    <body class="color">
        <h1 class="text">Форма за вход в системата</h1>
        <form id="login" action="#" method="post">
            <table>
                <tr><td>
                        <label class="text">Потребителско име:</label></td>
                    <td><input type="text" id="username" name="username" required /></td></tr>
                <tr><td>
                        <label class="text">Парола:</label></td>
                    <td><input type="password" id="pass" name="pass" required /></td></tr>
                <tr><td><input type="submit" name="input" value="Вход" />
                        <input type="reset" name="clear" value="Изчисти" /></td></tr>
            </table>
        </form>
		<script type="text/javascript" src="js/jquery-validation-1.14.0/lib/jquery-1.11.1.js"></script>
		<script type="text/javascript" src="js/jquery-validation-1.14.0/dist/jquery.validate.min.js"></script>
		<script type="text/javascript" src="js/jquery-validation-1.14.0/dist/additional-methods.js"></script>
		<script type="text/javascript">
		// Задаване на подразбиращи се настройки на валидатора.
		jQuery.validator.setDefaults({
			debug: false,
			success: "valid"
		});
		// Създаване на потребителски методи за валидация на формата - потребителско име и парола.
		jQuery.validator.addMethod("check_username", function(value, element) {
			var patern=/^[a-z][a-z0-9]+/;
			return this.optional(element)||patern.test(value);
		});
		jQuery.validator.addMethod("check_password", function(value, element) {
			var patern=/^[A-Za-z][A-Za-z0-9_]+/;
			return this.optional(element)||patern.test(value);
		});
		// Задаване на правила за валидация.
		$("#login").validate({
			rules: {
				username: {
					required: true,
					rangelength: [6, 20],
					check_username: true
				},
				pass: {
					required: true,
					minlength: 6,
					check_password: true
				}
			},
			// Задаване на съобщения за грешки, които ще се покажат при валидацията.
			messages: {
				username: {
					required: "Полето е задължително!",
					rangelength: "Потребителското име трябва да има най-малко 6 символа и най-много 20 символа!",
					check_username: "Въведеното потребителско име е невалидно!"
				},
				pass: {
					required: "Полето е задължително!",
					minlength: "Дължината на паролата трябва да има най-малко 6 символа!",
					check_password: "Въведената парола е невалидна!"
				}
			}
		});
		</script>
        <br />
        <div>
            <?php
			// Скрипт за вход на потребител.
            require_once 'db_connect.php';
            session_start();
            $username = filter_input(INPUT_POST, 'username');
            $pass = filter_input(INPUT_POST, 'pass');
            $input = filter_input(INPUT_POST, 'input');
            $seq_pass= md5($pass);
            $sql_select = "SELECT username FROM users WHERE (username='" . $username . "')AND(password='" . $seq_pass . "')";
            $_SESSION["username"] = $username;
            $result = $connect->query($sql_select);
            if (isset($input)) {
                if ($result->num_rows > 0) {
                    header("Location: home.html");
                } else {
                    header("Location: registration.php");
                }
            }
            $connect->close();
            ?>
        </div>
    </body>
</html>
