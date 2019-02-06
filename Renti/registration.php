<!DOCTYPE html>
<!--
Създаване на форма за регистрация на нов потребител в системата.
-->
<html>
    <head>
        <meta charset="UTF-8">
		<link rel="stylesheet" type="text/css" href="js/jquery-validation-1.14.0/demo/site-demos.css">
        <link rel="stylesheet" type="text/css" href="css/registration.css" />
		<script type="text/javascript" src="js/jquery-validation-1.14.0/lib/jquery-1.11.1.js"></script>
		<script type="text/javascript" src="js/jquery-validation-1.14.0/dist/jquery.validate.min.js"></script>
		<script type="text/javascript" src="js/jquery-validation-1.14.0/dist/additional-methods.js"></script>
        <title>Форма за регистрация на потребители</title>
    </head>
    <body class="color">
        <h1 class="text">Форма за регистрация на потребители</h1>
        <form id="registration" action="#" method="post">
            <table>
                <tr><td>
                        <label for="fname" class="text">Име:</label></td>
                    <td><input type="text" id="fname" name="fname" /></td></tr>
                <tr><td><label for="lname" class="text">Фамилия:</label></td>
                    <td><input type="text" id="lname" name="lname" /></td></tr>
                <tr><td><label for="username" class="text">Потребителско име:</label></td>
                    <td><input type="text" id="username" name="username" /></td></tr>
                <tr><td><label for="pass" class="text">Парола:</label></td>
                    <td><input type="password" id="pass" name="pass" /></td></tr>
                <tr><td><label for="pass2" class="text">Повтори паролата:</label></td>
                    <td><input type="password" id="pass2" name="pass2" /></td></tr>
                <tr><td><label for="email" class="text">Email:</label></td>
                    <td><input type="email" id="email" name="email" /></td></tr>
                <tr><td colspan="2"><input type="submit" id="register" name="register" value="Регистрирай се" onclick="redirect('login.php')"/>
                        <input type="reset" name="clear" value="Изчисти" /></td></tr>
            </table>
        </form>
		<script type="text/javascript">
		// Задаване на подразбиращи се настройки на валидатора.
		jQuery.validator.setDefaults({
			debug: false,
			success: "valid"
		});
		// Създаване на потребителски методи за валидация на формата - първото име, фамилията, потребителското име, паролата и парола за потвърждение при регистрация и email.
		jQuery.validator.addMethod("check_fname", function(value, element) {
			var patern=/^[А-Я][а-я]+/;
			return this.optional(element)||patern.test(value);
		});
		jQuery.validator.addMethod("check_lname", function(value, element) {
			var patern=/^[А-Я][а-я]+/;
			return this.optional(element)||patern.test(value);
		});
		jQuery.validator.addMethod("check_username", function(value, element) {
			var patern=/^[a-z][a-z0-9]+/;
			return this.optional(element)||patern.test(value);
		});
		jQuery.validator.addMethod("check_password", function(value, element) {
			var patern=/^[A-Za-z][A-Za-z0-9_]+/;
			return this.optional(element)||patern.test(value);
		});
		// Задаване на правила за валидация.
		$("#registration").validate({
			rules: {
				fname: {
					required: true,
					rangelength: [3, 15],
					check_fname: true
				},
				lname: {
					required: true,
					rangelength: [6, 20],
					check_lname: true
				},
				username: {
					required: true,
					rangelength: [6, 20],
					check_username: true
				},
				pass: {
					required: true,
					minlength: 6,
					check_password: true
				},
				pass2: {
					required: true,
					minlength: 6,
					check_password: true,
					equalTo: "#pass"
				},
				email: {
					required: true,
					email: true
				}
			},
			// Задаване на съобщения за грешки, които ще се покажат при валидацията.
			messages: {
				fname: {
					required: "Полето е задължително!",
					rangelength: "Името трябва да има най-малко 3 символа и най-много 15 символа!",
					check_fname: "Въведеното име е невалидно!"
				},
				lname: {
					required: "Полето е задължително!",
					rangelength: "Фамилията трябва да има най-малко 6 символа и най-много 20 символа!",
					check_lname: "Въведената фамилия е невалидна!"
				},
				username: {
					required: "Полето е задължително!",
					rangelength: "Потребителското име трябва да има най-малко 6 символа и най-много 20 символа!",
					check_username: "Въведеното потребителско име е невалидно!"
				},
				pass: {
					required: "Полето е задължително!",
					minlength: "Дължината на паролата трябва да има най-малко 6 символа!",
					check_password: "Въведената парола е невалидна!"
				},
				pass2: {
					required: "Полето е задължително!",
					minlength: "Дължината на паролата трябва да има най-малко 6 символа!",
					check_password: "Въведената парола е невалидна!",
					equalTo: "Въведените пароли са различни!"
				},
				email: {
					required: "Полето е задължително!",
					email: "Въведения email е невалиден!"
				}
			}
		});
		</script>
        <div>
            <?php
			// Скрипт за регистрация на нов потребител.
            require "db_connect.php";
            $fname = filter_input(INPUT_POST, "fname");
            $lname = filter_input(INPUT_POST, "lname");
            $username = filter_input(INPUT_POST, "username");
            $pass = filter_input(INPUT_POST, "pass");
            $pass2 = filter_input(INPUT_POST, "pass2");
            $email = filter_input(INPUT_POST, "email");
            $register = filter_input(INPUT_POST, 'register');
            $sequre_pass =  md5($pass);
            $sequre_pass2 = md5($pass2);
            if (isset($register)) {
               $sql_insert = "INSERT INTO users (fname,lname,username,password,email) VALUES ('" . $fname . "','" . $lname . "','" . $username . "','" . $sequre_pass . "','" . $email . "')";
               $connect->query($sql_insert);
			   echo "<script type='text/javascript'>";
			   echo "document.location='login.php'";
			   echo "</script>";
			}
            $connect->close();
            ?>
    </body>
</html>
