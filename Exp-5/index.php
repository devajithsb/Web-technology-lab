<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Employee Registration</title>
    <link rel="stylesheet" href="style.css">
    <style>
        /* === GLOBAL RESET & BASE === */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 20px;
            position: relative;
            overflow-x: hidden;
        }

        /* Animated background circles */
        body::before {
            content: '';
            position: absolute;
            width: 300px;
            height: 300px;
            background: rgba(255, 255, 255, 0.05);
            border-radius: 50%;
            top: -100px;
            right: -100px;
            animation: float 20s infinite;
        }

        body::after {
            content: '';
            position: absolute;
            width: 400px;
            height: 400px;
            background: rgba(255, 255, 255, 0.03);
            border-radius: 50%;
            bottom: -150px;
            left: -150px;
            animation: float 25s infinite reverse;
        }

        @keyframes float {
            0%, 100% { transform: translate(0, 0) scale(1); }
            50% { transform: translate(30px, -30px) scale(1.1); }
        }

        /* === CARD CONTAINER === */
        .container {
            width: 100%;
            max-width: 480px;
            margin: 0 auto;
            padding: 40px 35px;
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(20px);
            -webkit-backdrop-filter: blur(20px);
            border-radius: 28px;
            box-shadow: 
                0 30px 80px rgba(0, 0, 0, 0.25),
                0 0 0 1px rgba(255, 255, 255, 0.3) inset;
            position: relative;
            z-index: 1;
            animation: slideUp 0.6s ease-out;
        }

        @keyframes slideUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        /* === HEADINGS === */
        h2 {
            text-align: center;
            font-size: 32px;
            font-weight: 800;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            margin-bottom: 6px;
            letter-spacing: -0.5px;
        }

        .subtitle {
            text-align: center;
            color: #8b8fa7;
            font-size: 14px;
            margin-bottom: 30px;
            font-weight: 400;
            letter-spacing: 0.3px;
        }

        /* === FORM ELEMENTS === */
        label {
            display: block;
            margin-top: 20px;
            font-weight: 600;
            font-size: 14px;
            color: #2d3748;
            letter-spacing: 0.3px;
        }

        label .required {
            color: #fc8181;
            margin-left: 3px;
        }

        input, select {
            width: 100%;
            padding: 14px 18px;
            margin-top: 6px;
            border: 2px solid #e2e8f0;
            border-radius: 14px;
            font-size: 15px;
            background: #f7fafc;
            transition: all 0.3s ease;
            color: #2d3748;
            font-family: inherit;
        }

        input:focus, select:focus {
            outline: none;
            border-color: #667eea;
            background: #ffffff;
            box-shadow: 0 0 0 4px rgba(102, 126, 234, 0.15);
            transform: scale(1.01);
        }

        input:hover, select:hover {
            border-color: #a0aec0;
            background: #ffffff;
        }

        input::placeholder {
            color: #a0aec0;
            font-size: 14px;
        }

        select {
            cursor: pointer;
            appearance: none;
            background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='12' height='12' viewBox='0 0 12 12'%3E%3Cpath fill='%23667eea' d='M6 8L1 3h10z'/%3E%3C/svg%3E");
            background-repeat: no-repeat;
            background-position: right 16px center;
            padding-right: 40px;
        }

        select option {
            padding: 10px;
        }

        /* === BUTTON === */
        button {
            width: 100%;
            padding: 16px;
            margin-top: 32px;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            border: none;
            border-radius: 16px;
            font-size: 17px;
            font-weight: 700;
            cursor: pointer;
            transition: all 0.3s ease;
            letter-spacing: 0.5px;
            box-shadow: 0 6px 20px rgba(102, 126, 234, 0.4);
            position: relative;
            overflow: hidden;
        }

        button::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.2), transparent);
            transition: left 0.5s ease;
        }

        button:hover::before {
            left: 100%;
        }

        button:hover {
            transform: translateY(-3px);
            box-shadow: 0 10px 35px rgba(102, 126, 234, 0.5);
        }

        button:active {
            transform: translateY(0px);
            box-shadow: 0 4px 15px rgba(102, 126, 234, 0.3);
        }

        /* === LINKS === */
        .text-center {
            text-align: center;
            margin-top: 22px;
        }

        .text-center a {
            text-decoration: none;
            color: #667eea;
            font-weight: 600;
            font-size: 15px;
            transition: all 0.3s ease;
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 8px 20px;
            border-radius: 30px;
            background: rgba(102, 126, 234, 0.08);
        }

        .text-center a:hover {
            color: #764ba2;
            background: rgba(102, 126, 234, 0.18);
            transform: translateX(5px);
            box-shadow: 0 2px 12px rgba(102, 126, 234, 0.15);
        }

        /* === RESPONSIVE === */
        @media (max-width: 600px) {
            .container {
                padding: 30px 20px;
                border-radius: 20px;
            }

            h2 {
                font-size: 26px;
            }

            input, select {
                padding: 12px 16px;
                font-size: 14px;
            }

            button {
                font-size: 15px;
                padding: 14px;
            }
        }

        /* === TABLE STYLES (for view.php) === */
        .table-container {
            width: 100%;
            max-width: 1100px;
            margin: 30px auto;
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(20px);
            -webkit-backdrop-filter: blur(20px);
            padding: 28px 28px 32px;
            border-radius: 24px;
            box-shadow: 
                0 20px 60px rgba(0, 0, 0, 0.12),
                0 0 0 1px rgba(255, 255, 255, 0.3) inset;
            animation: slideUp 0.6s ease-out;
        }

        .table-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
            flex-wrap: wrap;
            gap: 12px;
        }

        .table-header h3 {
            font-size: 22px;
            font-weight: 800;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        .table-header .badge {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            padding: 6px 18px;
            border-radius: 30px;
            font-size: 13px;
            font-weight: 600;
        }

        table {
            width: 100%;
            border-collapse: separate;
            border-spacing: 0;
            border-radius: 16px;
            overflow: hidden;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
        }

        th {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            font-weight: 700;
            font-size: 13px;
            letter-spacing: 0.5px;
            text-transform: uppercase;
            padding: 16px 18px;
            border: none;
        }

        td {
            padding: 14px 18px;
            border-bottom: 1px solid #edf2f7;
            color: #2d3748;
            font-size: 14px;
        }

        tr:last-child td {
            border-bottom: none;
        }

        tr {
            background: white;
            transition: all 0.2s ease;
        }

        tr:hover td {
            background: #f7fafc;
            transform: scale(1.001);
        }

        th:first-child {
            border-radius: 16px 0 0 0;
        }

        th:last-child {
            border-radius: 0 16px 0 0;
        }

        tr:last-child td:first-child {
            border-radius: 0 0 0 16px;
        }

        tr:last-child td:last-child {
            border-radius: 0 0 16px 0;
        }

        @media (max-width: 600px) {
            .table-container {
                padding: 16px 12px 20px;
                border-radius: 18px;
            }

            th, td {
                padding: 10px 8px;
                font-size: 12px;
            }

            .table-header {
                flex-direction: column;
                align-items: flex-start;
            }
        }
    </style>
</head>
<body>

<div class="container">
    <h2> Employee Details</h2>
    <p class="subtitle">Fill in the information below to register a new employee</p>

    <form action="save.php" method="POST">

        <label>Employee Name <span class="required">*</span></label>
        <input type="text" name="name" placeholder="Enter full name" required>

        <label>Email <span class="required">*</span></label>
        <input type="email" name="email" placeholder="employee@company.com" required>

        <label>Phone Number <span class="required">*</span></label>
        <input type="text" name="phone" placeholder="Enter phone number" required>

        <label>Department <span class="required">*</span></label>
        <select name="department" required>
            <option value="">Select Department</option>
            <option value="Computer Science">Computer Science</option>
            <option value="HR">HR</option>
            <option value="Finance">Finance</option>
            <option value="Marketing">Marketing</option>
        </select>

        <label>Designation <span class="required">*</span></label>
        <input type="text" name="designation" placeholder="e.g., Software Developer" required>

        <label>Salary <span class="required">*</span></label>
        <input type="number" name="salary" step="0.01" placeholder="Enter salary amount" required>

        <button type="submit">💾 Save Employee</button>

    </form>

    <div class="text-center">
        <a href="view.php">📋 View All Employees</a>
    </div>
</div>

</body>
</html>