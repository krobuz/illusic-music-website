<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
    <style>
        .container { 
            width: 300px; 
            margin: 0 auto; 
            padding: 20px;
        }
        .form-group { 
            margin-bottom: 15px; 
        }
        input { 
            width: 100%; 
            padding: 8px;
            margin-top: 5px; 
        }
        button { 
            width: 100%; 
            padding: 10px; 
            background: #4CAF50; 
            color: white; 
            border: none; 
            cursor: pointer; 
        }
        .alert {
            padding: 10px;
            margin-bottom: 15px;
            border-radius: 4px;
        }
        .alert-error {
            background-color: #f44336;
            color: white;
        }
        .alert-success {
            background-color: #4CAF50;
            color: white;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Login</h2>
        <?php if (isset($_SESSION['error'])): ?>
            <div class="alert alert-error">
                <?php 
                    echo $_SESSION['error'];
                    unset($_SESSION['error']);
                ?>
            </div>
        <?php endif; ?>
        <?php if (isset($_SESSION['message'])): ?>
            <div class="alert alert-success">
                <?php 
                    echo $_SESSION['message'];
                    unset($_SESSION['message']);
                ?>
            </div>
        <?php endif; ?>
        <form action="/music_website/login" method="POST">
            <div class="form-group">
                <label>Username:</label>
                <input type="text" name="username" required>
            </div>
            <div class="form-group">
                <label>Password:</label>
                <input type="password" name="password" required>
            </div>
            <button type="submit">Login</button>
        </form>
        <p>Don't have an account? <a href="/music_website/register">Register here</a></p>
        <p>Discover more at: <a href="/music_website">Home Page</a></p>
    </div>
</body>
</html>