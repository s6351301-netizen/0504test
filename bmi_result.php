<!DOCTYPE html>
<html lang="zh-Hant">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BMI計算結果</title>
    
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
        body {
            min-height: 100vh;
            background: linear-gradient(135deg, #667eea, #764ba2);
            display: flex;
            justify-content: center;
            align-items: center;
            font-family: "Segoe UI", sans-serif;
            padding: 20px;
        }
        
        /* 卡片容器 */
        .card {
            background: rgba(255,255,255,0.1);
            backdrop-filter: blur(15px);
            border-radius: 20px;
            padding: 20px 30px;
            width: 100%;
            max-width: 400px;
            color: white;
            box-shadow: 0 20px 40px rgba(0,0,0,0.3);
            text-align: center;
            position: relative;
            overflow: hidden;
        }
        
        /* 光暈動畫 */
        .card::before {
            content: "";
            position: absolute;
            width: 200%;
            height: 200%;
            background: radial-gradient(circle, rgba(255,255,255,0.3), transparent);
            top: -50%;
            left: -50%;
            animation: rotate 8s linear infinite;
        }
        
        @keyframes rotate {
            0% { transform: rotate(0deg); }
            100% { transform: rotate(360deg); }
        }
        
        .card-content {
            position: relative;
            z-index: 1;
        }
        
        /* 小裝飾 icon */
        .icon-top {
            font-size: 40px;
            margin-bottom: 15px;
            color: #ffd6e0;
        }
        
        h1 {
            margin-bottom: 10px;
            font-weight: 600;
            font-size: 28px;
        }
        
        .subtitle {
            font-size: 14px;
            opacity: 0.9;
            margin-bottom: 30px;
        }
        
        /* 結果信息 */
        .info-item {
            background: rgba(255,255,255,0.15);
            padding: 15px;
            border-radius: 12px;
            margin: 12px 0;
            font-size: 16px;
        }
        
        .info-label {
            font-size: 14px;
            opacity: 0.85;
            margin-bottom: 5px;
        }
        
        .info-value {
            font-size: 22px;
            font-weight: 600;
            color: #ffd6e0;
        }
        
        /* BMI結果特殊樣式 */
        .result-box {
            background: rgba(255,255,255,0.2);
            padding: 25px;
            border-radius: 15px;
            margin: 20px 0;
            border: 2px solid rgba(255,255,255,0.3);
        }
        
        .result-value {
            font-size: 48px;
            font-weight: 700;
            color: #ff7eb3;
            margin: 10px 0;
        }
        
        .result-status {
            font-size: 28px;
            font-weight: 600;
            color: #ffd6e0;
            text-transform: uppercase;
            letter-spacing: 2px;
        }
        
        /* 返回按鈕 */
        .btn-group {
            display: flex;
            gap: 10px;
            margin-top: 30px;
        }
        
        a.btn {
            flex: 1;
            padding: 12px 20px;
            border: none;
            border-radius: 10px;
            background: linear-gradient(135deg, #ff7eb3, #ff758c);
            color: white;
            text-decoration: none;
            font-size: 16px;
            cursor: pointer;
            transition: 0.3s;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
        }
        
        a.btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 20px rgba(0,0,0,0.3);
        }
        
        /* 錯誤樣式 */
        .error-box {
            background: rgba(255,107,107,0.2);
            border: 2px solid rgba(255,107,107,0.5);
            padding: 20px;
            border-radius: 15px;
            margin-bottom: 20px;
        }
        
        .error-box i {
            margin-right: 10px;
            font-size: 24px;
        }
        
        .error-message {
            font-size: 18px;
            font-weight: 600;
        }
    </style>
</head>
<body>
    <div class="card">
        <div class="card-content">
            <?php 
            if(isset($_GET['height'])){
                $height=$_GET['height'];
            }
            if(isset($_GET['weight'])){
                $weight=$_GET['weight'];
            }
            if(isset($_POST['height'])){
                $height=$_POST['height'];
            }
            if(isset($_POST['weight'])){
                $weight=$_POST['weight'];
            }
            if(empty($height) OR empty($weight)){
                ?>
                <div class="icon-top">
                    <i class="fa-solid fa-circle-exclamation"></i>
                </div>
                <h1>計算錯誤</h1>
                <div class="error-box">
                    <i class="fa-solid fa-triangle-exclamation"></i>
                    <span class="error-message">資料有誤，請重新填寫</span>
                </div>
                <div class="btn-group">
                    <a href="06-BMI.php" class="btn">
                        <i class="fa-solid fa-arrow-left"></i> 回到計算
                    </a>
                </div>
                <?php
                exit();
            }
            
            $BMI=round($weight/(($height/100)*($height/100)),2);
            
            if($BMI>=27){
                $result="肥胖";
                $icon="fa-person-hiking";
            }else if($BMI>=24){
                $result="過重";
                $icon="fa-person-walking";
            }else if($BMI>=18.5){
                $result="正常";
                $icon="fa-heart-pulse";
            }else{
                $result="過輕";
                $icon="fa-person-running";
            }
            ?>
            
            <div class="icon-top">
                <i class="fa-solid <?= $icon; ?>"></i>
            </div>
            
            <h1>BMI 計算結果</h1>
            <p class="subtitle">你的健康指數分析</p>
            
            <div class="info-item">
                <div class="info-label"><i class="fa-solid fa-ruler-vertical"></i> 身高</div>
                <div class="info-value"><?= $height; ?> cm</div>
            </div>
            
            <div class="info-item">
                <div class="info-label"><i class="fa-solid fa-weight-scale"></i> 體重</div>
                <div class="info-value"><?= $weight; ?> kg</div>
            </div>
            
            <div class="result-box">
                <div class="info-label">BMI 指數</div>
                <div class="result-value"><?= $BMI; ?></div>
                <div class="result-status"><?= $result; ?></div>
            </div>
            
            <div class="btn-group">
                <a href="06-BMI.php" class="btn">
                    <i class="fa-solid fa-calculator"></i> 重新計算
                </a>
            </div>
        </div>
    </div>
</body>
</html>