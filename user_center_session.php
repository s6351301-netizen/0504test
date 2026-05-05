<?php
session_start();

if(!isset($_SESSION['login'])){
    if(!($_POST['username']=='mack' && $_POST['password']=='1234')){
        echo "帳號或密碼錯誤,請重新登入";
        echo "<a href='07-login-get.php'>登入</a>";
        exit();
    }

    $_SESSION['login']=1;
}


?>


<!DOCTYPE html>
<html lang="zh-Hant">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>會員中心</title>
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
            padding-top: 20px;
            padding-bottom: 20px;
            position: relative;
            overflow-x: hidden;
        }

        /* 幾何裝飾 - 圓圈 */
        .decoration-circle {
            position: fixed;
            border-radius: 50%;
            opacity: 0.5;
            pointer-events: none;
        }

        .circle-1 {
            width: 120px;
            height: 120px;
            background: #fff9c4;
            top: 5%;
            right: 5%;
            animation: float 6s ease-in-out infinite;
        }

        .circle-2 {
            width: 70px;
            height: 70px;
            background: #c8e6c9;
            bottom: 15%;
            left: 5%;
            animation: float 8s ease-in-out infinite reverse;
        }

        .circle-3 {
            width: 90px;
            height: 90px;
            background: #f8bbd0;
            top: 50%;
            right: 3%;
            animation: float 7s ease-in-out infinite;
        }

        /* 幾何裝飾 - 三角形 */
        .decoration-triangle {
            position: fixed;
            opacity: 0.4;
            pointer-events: none;
        }

        .triangle-1 {
            width: 0;
            height: 0;
            border-left: 35px solid transparent;
            border-right: 35px solid transparent;
            border-bottom: 60px solid #bbdefb;
            top: 30%;
            left: 5%;
            animation: rotate 12s linear infinite;
        }

        .triangle-2 {
            width: 0;
            height: 0;
            border-left: 28px solid transparent;
            border-right: 28px solid transparent;
            border-bottom: 48px solid #b2dfdb;
            bottom: 20%;
            right: 10%;
            animation: rotate 10s linear infinite reverse;
        }

        /* 幾何裝飾 - 方形 */
        .decoration-square {
            position: fixed;
            opacity: 0.4;
            pointer-events: none;
            transform: rotate(45deg);
        }

        .square-1 {
            width: 60px;
            height: 60px;
            background: #c8e6c9;
            top: 10%;
            left: 8%;
            animation: bounce 5s ease-in-out infinite;
        }

        .square-2 {
            width: 50px;
            height: 50px;
            background: #bbdefb;
            bottom: 30%;
            right: 8%;
            animation: bounce 6s ease-in-out infinite reverse;
        }

        @keyframes float {
            0%, 100% { transform: translateY(0px); }
            50% { transform: translateY(25px); }
        }

        @keyframes rotate {
            0% { transform: rotate(0deg); }
            100% { transform: rotate(360deg); }
        }

        @keyframes bounce {
            0%, 100% { transform: translateY(0px) rotate(45deg); }
            50% { transform: translateY(-20px) rotate(45deg); }
        }

        /* 頭部導航 */
        header {
            background: white;
            padding: 20px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.06);
            border-radius: 20px;
            margin: 0 20px 30px 20px;
            position: relative;
            z-index: 10;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .logo {
            font-size: 28px;
            font-weight: 700;
            color: #5e6c84;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .logo-icon {
            font-size: 32px;
        }

        .logout-btn {
            padding: 10px 20px;
            background: linear-gradient(135deg, #ffab91 0%, #ff8a65 100%);
            color: white;
            border: none;
            border-radius: 12px;
            font-size: 14px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            font-family: inherit;
        }

        .logout-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 15px rgba(255, 152, 0, 0.3);
        }

        /* 主容器 */
        .main-container {
            max-width: 1000px;
            margin: 0 auto;
            padding: 0 20px;
            position: relative;
            z-index: 5;
        }

        /* 歡迎區 */
        .welcome-section {
            background: linear-gradient(135deg, #a5d6a7 0%, #81c784 100%);
            padding: 40px;
            border-radius: 25px;
            color: white;
            margin-bottom: 30px;
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.1);
        }

        .welcome-section h2 {
            font-size: 32px;
            margin-bottom: 10px;
            font-weight: 700;
        }

        .welcome-section p {
            font-size: 16px;
            opacity: 0.95;
            margin-bottom: 20px;
        }

        .welcome-emoji {
            font-size: 60px;
            float: right;
            opacity: 0.7;
            margin-left: 20px;
        }

        /* 內容區域 */
        .content-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 25px;
            margin-bottom: 30px;
        }

        /* 卡片 */
        .card {
            background: white;
            padding: 30px;
            border-radius: 20px;
            box-shadow: 0 6px 20px rgba(0, 0, 0, 0.07);
            transition: all 0.3s ease;
        }

        .card:hover {
            transform: translateY(-5px);
            box-shadow: 0 12px 30px rgba(0, 0, 0, 0.12);
        }

        .card-header {
            display: flex;
            align-items: center;
            gap: 15px;
            margin-bottom: 20px;
            padding-bottom: 20px;
            border-bottom: 2px solid #f0f0f0;
        }

        .card-icon {
            font-size: 40px;
        }

        .card-title {
            font-size: 18px;
            font-weight: 700;
            color: #5e6c84;
        }

        .card-content {
            color: #5e6c84;
            font-size: 14px;
            line-height: 1.8;
            margin-bottom: 20px;
        }

        .card-link {
            display: inline-block;
            padding: 10px 18px;
            background: linear-gradient(135deg, #a5d6a7 0%, #81c784 100%);
            color: white;
            border-radius: 10px;
            text-decoration: none;
            font-size: 13px;
            font-weight: 600;
            transition: all 0.3s ease;
        }

        .card-link:hover {
            transform: translateX(3px);
            box-shadow: 0 4px 12px rgba(129, 199, 132, 0.3);
        }

        /* 用戶信息卡片 */
        .user-info-card {
            background: linear-gradient(135deg, #e0f2f1 0%, #b2dfdb 100%);
            padding: 30px;
            border-radius: 20px;
            color: #00695c;
        }

        .user-info-card .card-title {
            color: #00695c;
        }

        .info-item {
            margin: 15px 0;
            padding: 12px;
            background: rgba(255, 255, 255, 0.5);
            border-radius: 12px;
            border-left: 4px solid #a5d6a7;
        }

        .info-label {
            font-size: 12px;
            opacity: 0.7;
            margin-bottom: 5px;
        }

        .info-value {
            font-size: 18px;
            font-weight: 700;
        }

        /* 裝飾線條 */
        .decorative-line {
            height: 3px;
            background: linear-gradient(90deg, transparent, #a5d6a7, transparent);
            margin: 40px 0;
            border-radius: 2px;
        }

        /* 底部區域 */
        footer {
            text-align: center;
            padding: 30px;
            color: #a9b7c0;
            font-size: 14px;
            position: relative;
            z-index: 5;
        }

        /* 響應式設計 */
        @media (max-width: 768px) {
            header {
                flex-direction: column;
                gap: 15px;
            }

            .welcome-section {
                padding: 30px 20px;
            }

            .welcome-section h2 {
                font-size: 24px;
            }

            .content-grid {
                grid-template-columns: 1fr;
            }

            .decoration-circle,
            .decoration-triangle,
            .decoration-square {
                display: none;
            }

            .main-container {
                padding: 0 15px;
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

    <!-- 頭部 -->
    <header>
        <div class="logo">
            <span class="logo-icon">🏡</span>
            <span>會員中心</span>
        </div>
        <form method="GET" style="margin: 0;">
            <a href='07-login-get.php'class="logout-btn">登出</a>
        </form>
    </header>

    <!-- 主內容 -->
    <div class="main-container">
        <!-- 歡迎區 -->
        <div class="welcome-section">
            <div class="welcome-emoji">🌻</div>
            <h2>歡迎回來！</h2>
            <p>
                <?php
                $username = isset($_POST['username']) ? htmlspecialchars($_POST['username']) : '訪客';
                echo $username;
                ?>
            </p>
            <p style="margin: 0;">祝你有美好的一天！ 🌈</p>
        </div>

        <div class="decorative-line"></div>

        <!-- 內容區域 -->
        <div class="content-grid">
            <!-- 用戶信息卡片 -->
            <div class="card user-info-card">
                <div class="card-header">
                    <div class="card-icon">👤</div>
                    <div class="card-title">個人信息</div>
                </div>
                <div class="info-item">
                    <div class="info-label">帳號</div>
                    <div class="info-value">
                        <?php echo isset($_GET['username']) ? htmlspecialchars($_GET['username']) : '未設定'; ?>
                    </div>
                </div>
                <div class="info-item">
                    <div class="info-label">會員等級(<?= $_SESSION['login']; ?>)</div>
                    <div class="info-value">🌟 普通會員</div>
                </div>
                <div class="info-item">
                    <div class="info-label">加入日期</div>
                    <div class="info-value">2026 年 5 月</div>
                </div>
            </div>

            <!-- 功能卡片 1 -->
            <div class="card">
                <div class="card-header">
                    <div class="card-icon">📊</div>
                    <div class="card-title">我的統計</div>
                </div>
                <div class="card-content">
                    查看你的各項成就、簽到天數、以及個人統計數據。
                </div>
                <a href="#" class="card-link">查看詳情</a>
            </div>

            <!-- 功能卡片 2 -->
            <div class="card">
                <div class="card-header">
                    <div class="card-icon">⚙️</div>
                    <div class="card-title">帳號設定</div>
                </div>
                <div class="card-content">
                    修改個人資訊、密碼、隱私設定等帳號相關選項。
                </div>
                <a href="#" class="card-link">進入設定</a>
            </div>

            <!-- 功能卡片 3 -->
            <div class="card">
                <div class="card-header">
                    <div class="card-icon">🎁</div>
                    <div class="card-title">獎勵積分</div>
                </div>
                <div class="card-content">
                    查看你的積分餘額，並兌換各種精美獎品。
                </div>
                <a href="#" class="card-link">兌換獎品</a>
            </div>

            <!-- 功能卡片 4 -->
            <div class="card">
                <div class="card-header">
                    <div class="card-icon">💬</div>
                    <div class="card-title">訊息中心</div>
                </div>
                <div class="card-content">
                    查看系統通知、活動資訊、以及其他重要訊息。
                </div>
                <a href="#" class="card-link">查看訊息</a>
            </div>

            <!-- 功能卡片 5 -->
            <div class="card">
                <div class="card-header">
                    <div class="card-icon">❤️</div>
                    <div class="card-title">我的收藏</div>
                </div>
                <div class="card-content">
                    管理你喜愛的項目、書籤和其他收藏內容。
                </div>
                <a href="#" class="card-link">查看收藏</a>
            </div>

            <!-- 功能卡片 6 -->
            <div class="card">
                <div class="card-header">
                    <div class="card-icon">📞</div>
                    <div class="card-title">客服支援</div>
                </div>
                <div class="card-content">
                    如有任何問題或建議，歡迎聯繫我們的客服團隊。
                </div>
                <a href="#" class="card-link">聯繫客服</a>
            </div>
        </div>
    </div>

    <!-- 底部 -->
    <footer>
        <p>© 2026 會員中心 · 帶著溫暖和快樂享受每一天 🌻</p>
    </footer>
</body>
</html>