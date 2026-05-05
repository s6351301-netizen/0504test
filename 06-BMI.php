<!DOCTYPE html>
<html lang="zh-Hant">
<head>
<meta charset="UTF-8">
<title>BMI計算器</title>

<!-- Font Awesome -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

<style>
* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
}

body {
    height: 100vh;
    background: linear-gradient(135deg, #667eea, #764ba2);
    display: flex;
    justify-content: space-around;
    flex-wrap:wrap;
    align-items: center;
    font-family: "Segoe UI", sans-serif;
}

/* 卡片 */
.card {
    background: rgba(255,255,255,0.1);
    backdrop-filter: blur(15px);
    border-radius: 20px;
    padding: 40px 30px;
    width: 320px;
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

/* 標題 */
h2 {
    margin-bottom: 25px;
    font-weight: 600;
}

/* 輸入框 */
.input-group {
    position: relative;
    margin: 20px 0;
}

.input-group i {
    position: absolute;
    top: 50%;
    left: 12px;
    transform: translateY(-50%);
    color: #ddd;
}

.input-group input {
    width: 100%;
    padding: 12px 12px 12px 38px;
    border: none;
    border-radius: 10px;
    outline: none;
    background: rgba(255,255,255,0.2);
    color: white;
    font-size: 14px;
}

.input-group input::placeholder {
    color: #eee;
}

/* 按鈕 */
button {
    margin-top: 20px;
    width: 100%;
    padding: 12px;
    border: none;
    border-radius: 10px;
    background: linear-gradient(135deg, #ff7eb3, #ff758c);
    color: white;
    font-size: 16px;
    cursor: pointer;
    transition: 0.3s;
}

button:hover {
    transform: translateY(-2px);
    box-shadow: 0 10px 20px rgba(0,0,0,0.3);
}

/* 小裝飾 icon */
.icon-top {
    font-size: 30px;
    margin-bottom: 10px;
    color: #ffd6e0;
}
</style>
</head>

<body>
    <div style="width:100%;">
        <h2>BMI 計算</h2>
     
     <ul>
         <li>建立一個可以輸入身高和體重的表單畫面</li>
         <li>按下"計算BMI"按鈕後，在另一個頁面顯示BMI值</li>
     </ul>
    </div>
<div class="card">
    <div class="card-content">
        <div class="icon-top">
            <i class="fa-solid fa-heart-pulse"></i>
        </div>
        <h2>BMI 計算表單(GET)</h2>

        <form action="bmi_result.php" method="get">
            <div class="input-group">
                <i class="fa-solid fa-ruler-vertical"></i>
                <input type="number" name="height" placeholder="請輸入身高 (cm)">
            </div>

            <div class="input-group">
                <i class="fa-solid fa-weight-scale"></i>
                <input type="number" name="weight" placeholder="請輸入體重 (kg)">
            </div>

            <button type="submit">
                <i class="fa-solid fa-calculator"></i> 送出計算
            </button>
        </form>
    </div>
</div>
<div class="card">
    <div class="card-content">
        <div class="icon-top">
            <i class="fa-solid fa-heart-pulse"></i>
        </div>
        <h2>BMI 計算表單(POST)</h2>

        <form action="bmi_result.php" method="post">
            <div class="input-group">
                <i class="fa-solid fa-ruler-vertical"></i>
                <input type="number" name="height" placeholder="請輸入身高 (cm)">
            </div>

            <div class="input-group">
                <i class="fa-solid fa-weight-scale"></i>
                <input type="number" name="weight" placeholder="請輸入體重 (kg)">
            </div>
            <button type="submit">
                <i class="fa-solid fa-calculator"></i> 送出計算
            </button>
        </form>
    </div>
</div>

</body>
</html>