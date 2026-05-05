<!DOCTYPE html>
<html lang="zh-Hant">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>登入(COOKIE)</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: "Comic Sans MS", "Segoe UI", sans-serif;
            background: linear-gradient(135deg, #e8f5e9 0%, #e1f5fe 50%, #f3e5f5 100%);
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 20px;
            position: relative;
            overflow-x: hidden;
        }

        /* 幾何裝飾 - 圓圈 */
        .decoration-circle {
            position: fixed;
            border-radius: 50%;
            opacity: 0.6;
            pointer-events: none;
        }

        .circle-1 {
            width: 100px;
            height: 100px;
            background: #fff9c4;
            top: 10%;
            left: 5%;
            animation: float 6s ease-in-out infinite;
        }

        .circle-2 {
            width: 60px;
            height: 60px;
            background: #c8e6c9;
            top: 70%;
            right: 8%;
            animation: float 8s ease-in-out infinite reverse;
        }

        .circle-3 {
            width: 80px;
            height: 80px;
            background: #bbdefb;
            bottom: 10%;
            left: 10%;
            animation: float 7s ease-in-out infinite;
        }

        /* 幾何裝飾 - 三角形 */
        .decoration-triangle {
            position: fixed;
            opacity: 0.5;
            pointer-events: none;
        }

        .triangle-1 {
            width: 0;
            height: 0;
            border-left: 30px solid transparent;
            border-right: 30px solid transparent;
            border-bottom: 52px solid #f8bbd0;
            top: 20%;
            right: 10%;
            animation: rotate 10s linear infinite;
        }

        .triangle-2 {
            width: 0;
            height: 0;
            border-left: 25px solid transparent;
            border-right: 25px solid transparent;
            border-bottom: 43px solid #b3e5fc;
            bottom: 25%;
            right: 5%;
            animation: rotate 12s linear infinite reverse;
        }

        /* 幾何裝飾 - 方形 */
        .decoration-square {
            position: fixed;
            opacity: 0.5;
            pointer-events: none;
            transform: rotate(45deg);
        }

        .square-1 {
            width: 50px;
            height: 50px;
            background: #f0f4c3;
            top: 50%;
            left: 5%;
            animation: bounce 4s ease-in-out infinite;
        }

        .square-2 {
            width: 40px;
            height: 40px;
            background: #c8e6c9;
            top: 15%;
            right: 20%;
            animation: bounce 5s ease-in-out infinite reverse;
        }

        @keyframes float {
            0%, 100% { transform: translateY(0px); }
            50% { transform: translateY(20px); }
        }

        @keyframes rotate {
            0% { transform: rotate(0deg); }
            100% { transform: rotate(360deg); }
        }

        @keyframes bounce {
            0%, 100% { transform: translateY(0px) rotate(45deg); }
            50% { transform: translateY(-15px) rotate(45deg); }
        }

        /* 主容器 */
        .container {
            background: white;
            padding: 50px 40px;
            border-radius: 30px;
            box-shadow: 0 10px 40px rgba(0, 0, 0, 0.08);
            width: 100%;
            max-width: 380px;
            position: relative;
            z-index: 10;
        }

        /* 標題區域 */
        .header {
            text-align: center;
            margin-bottom: 40px;
        }

        .header-icon {
            font-size: 60px;
            margin-bottom: 15px;
        }

        h1 {
            color: #5e6c84;
            font-size: 28px;
            font-weight: 600;
            margin-bottom: 8px;
        }

        .subtitle {
            color: #a9b7c0;
            font-size: 14px;
        }

        /* 表單區域 */
        .form-group {
            margin-bottom: 25px;
        }

        label {
            display: block;
            color: #5e6c84;
            font-size: 14px;
            font-weight: 600;
            margin-bottom: 8px;
            margin-left: 5px;
        }

        input[type="text"],
        input[type="password"] {
            width: 100%;
            padding: 12px 15px;
            border: 2px solid #e8f5e9;
            border-radius: 15px;
            font-size: 14px;
            font-family: inherit;
            background: #f8fffe;
            color: #5e6c84;
            transition: all 0.3s ease;
        }

        input[type="text"]:focus,
        input[type="password"]:focus {
            outline: none;
            border-color: #a5d6a7;
            background: #f1f8f6;
            box-shadow: 0 0 0 3px rgba(165, 214, 167, 0.1);
        }

        input::placeholder {
            color: #cbd5e0;
        }

        /* 按鈕 */
        .submit-btn {
            width: 100%;
            padding: 14px;
            background: linear-gradient(135deg, #a5d6a7 0%, #81c784 100%);
            color: white;
            border: none;
            border-radius: 15px;
            font-size: 16px;
            font-weight: 600;
            font-family: inherit;
            cursor: pointer;
            transition: all 0.3s ease;
            margin-top: 10px;
        }

        .submit-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 20px rgba(165, 214, 167, 0.4);
        }

        .submit-btn:active {
            transform: translateY(0);
        }

        /* 下方連結 */
        .footer-link {
            text-align: center;
            margin-top: 25px;
            color: #a9b7c0;
            font-size: 14px;
        }

        .footer-link a {
            color: #a5d6a7;
            text-decoration: none;
            font-weight: 600;
            transition: color 0.3s ease;
        }

        .footer-link a:hover {
            color: #81c784;
        }

        /* 裝飾線條 */
        .divider {
            margin: 25px 0;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .divider-line {
            flex: 1;
            height: 1px;
            background: #f0f0f0;
        }

        .divider-text {
            color: #cbd5e0;
            font-size: 12px;
        }

        /* 響應式設計 */
        @media (max-width: 480px) {
            .container {
                padding: 40px 25px;
            }

            h1 {
                font-size: 24px;
            }

            .decoration-circle,
            .decoration-triangle,
            .decoration-square {
                display: none;
            }
        }
    </style>
</head>
<body>
    <!-- 幾何裝飾 -->
    <div class="decoration-circle circle-1"></div>
    <div class="decoration-circle circle-2"></div>
    <div class="decoration-circle circle-3"></div>
    <div class="decoration-triangle triangle-1"></div>
    <div class="decoration-triangle triangle-2"></div>
    <div class="decoration-square square-1"></div>
    <div class="decoration-square square-2"></div>

    <!-- 登入表單 -->
    <div class="container">
        <div class="header">
            <div class="header-icon">🌿</div>
            <h1>歡迎登入(COOKIE)</h1>
            <p class="subtitle">開始你的冒險旅程</p>
        </div>

        <form action="user_center_cookie.php" method="post">
            <div class="form-group">
                <label for="username">帳號</label>
                <input type="text" id="username" name="username" placeholder="請輸入帳號" required>
            </div>

            <div class="form-group">
                <label for="password">密碼</label>
                <input type="password" id="password" name="password" placeholder="請輸入密碼" required>
            </div>

            <button type="submit" class="submit-btn">登入</button>
        </form>

        <div class="divider">
            <div class="divider-line"></div>
            <span class="divider-text">或</span>
            <div class="divider-line"></div>
        </div>

        <div class="footer-link">
            還沒有帳號？ <a href="#">立即註冊</a>
        </div>
    </div>
</body>
</html>