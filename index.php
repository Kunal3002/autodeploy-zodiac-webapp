<html>
<head>
    <meta charset="utf-8">
    <title>Welcome to $SERVERNAME</title>

    <style>
        body {
            font-family: Arial, sans-serif;
            text-align: center;
            background-color: #f9f9f9;
            padding-top: 80px;
        }

        .container {
            display: inline-block;
            padding: 20px;
        }

        input {
            padding: 10px;
            margin: 6px;
            border-radius: 6px;
            border: 1px solid #ccc;
            width: 260px;
        }

        button {
            background-color: #007bff;
            color: #fff;
            border: none;
            cursor: pointer;
            width: 160px;
            padding: 12px;
            border-radius: 6px;
        }

        button:hover {
            background-color: #005fcc;
        }

        label {
            font-size: 14px;
            display: block;
            margin-top: 12px;
            margin-bottom: 4px;
            text-align: left;
            width: 260px;
            margin-left: auto;
            margin-right: auto;
        }
    </style>
</head>
<body>

<div class="container">
    <h1>Welcome to $SERVERNAME</h1>
    <p>Enter your details to see your day prediction!</p>

    <form action="info.php" method="post">
        <input type="text" name="name" placeholder="Your Name" required><br>
        <input type="email" name="email" placeholder="Your Email" required><br>

        <!-- Safari-friendly date input -->
        <label for="birthdate">Date of Birth</label>
        <input
            type="text"
            id="birthdate"
            name="birthdate"
            placeholder="dd - mm - yyyy"
            onfocus="this.type='date'"
            onblur="if(!this.value)this.type='text'"
            required
        ><br>

        <button type="submit">See My Day</button>
    </form>
</div>

</body>
</html>

