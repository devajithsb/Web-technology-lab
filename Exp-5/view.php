<?php
include "db.php";

$sql = "SELECT * FROM employees";
$result = mysqli_query($conn, $sql);
$row_count = mysqli_num_rows($result);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Employee Details</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>

<!-- Background Particles -->
<div class="bg-particles">
    <span></span>
    <span></span>
    <span></span>
</div>

<div class="table-container">

    <!-- Table Header with Stats -->
    <div class="table-header">
        <div>
            <h3>👥 Employee Directory</h3>
            <p style="color: #8b8fa7; font-size: 14px; margin-top: 4px;">
                Manage and view all employee records
            </p>
        </div>
        <div style="display: flex; gap: 12px; align-items: center; flex-wrap: wrap;">
            <span class="badge">
                📊 <?php echo $row_count; ?> Employees
            </span>
            <a href="index.php" style="
                background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
                color: white;
                padding: 8px 20px;
                border-radius: 30px;
                text-decoration: none;
                font-weight: 600;
                font-size: 14px;
                transition: all 0.3s ease;
                display: inline-flex;
                align-items: center;
                gap: 6px;
                box-shadow: 0 4px 15px rgba(102, 126, 234, 0.3);
            ">
                ➕ Add New
            </a>
        </div>
    </div>

    <!-- Search & Filter Bar -->
    <div style="
        margin-bottom: 20px;
        display: flex;
        gap: 12px;
        flex-wrap: wrap;
        align-items: center;
    ">
        <div style="flex: 1; min-width: 200px; position: relative;">
            <input type="text" id="searchInput" placeholder="🔍 Search employees..." style="
                width: 100%;
                padding: 12px 18px;
                border: 2px solid #e2e8f0;
                border-radius: 14px;
                font-size: 14px;
                background: #f7fafc;
                transition: all 0.3s ease;
                padding-left: 45px;
            ">
            <span style="
                position: absolute;
                left: 15px;
                top: 50%;
                transform: translateY(-50%);
                color: #a0aec0;
                font-size: 18px;
            ">🔍</span>
        </div>
        <select id="filterDept" style="
            padding: 12px 18px;
            border: 2px solid #e2e8f0;
            border-radius: 14px;
            font-size: 14px;
            background: #f7fafc;
            cursor: pointer;
            min-width: 160px;
            transition: all 0.3s ease;
        ">
            <option value="">All Departments</option>
            <option value="Computer Science">Computer Science</option>
            <option value="HR">HR</option>
            <option value="Finance">Finance</option>
            <option value="Marketing">Marketing</option>
        </select>
    </div>

    <!-- Table -->
    <div style="overflow-x: auto;">
        <table>
            <thead>
                <tr>
                    <th>#</th>
                    <th>👤 Name</th>
                    <th>📧 Email</th>
                    <th>📱 Phone</th>
                    <th>🏢 Department</th>
                    <th>💼 Designation</th>
                    <th>💰 Salary</th>
                </tr>
            </thead>
            <tbody id="employeeTableBody">
                <?php
                $counter = 1;
                while ($row = mysqli_fetch_assoc($result)) {
                    // Format salary with currency
                    $salary = number_format($row['salary'], 2);
                    
                    // Department color coding
                    $dept_colors = [
                        'Computer Science' => '#667eea',
                        'HR' => '#48bb78',
                        'Finance' => '#ed8936',
                        'Marketing' => '#fc8181'
                    ];
                    $dept_color = isset($dept_colors[$row['department']]) ? $dept_colors[$row['department']] : '#a0aec0';
                ?>
                    <tr class="employee-row" data-department="<?php echo $row['department']; ?>">
                        <td><strong><?php echo $counter++; ?></strong></td>
                        <td><strong><?php echo htmlspecialchars($row['name']); ?></strong></td>
                        <td><?php echo htmlspecialchars($row['email']); ?></td>
                        <td><?php echo htmlspecialchars($row['phone']); ?></td>
                        <td>
                            <span style="
                                background: <?php echo $dept_color; ?>;
                                color: white;
                                padding: 4px 12px;
                                border-radius: 20px;
                                font-size: 12px;
                                font-weight: 600;
                                display: inline-block;
                            ">
                                <?php echo htmlspecialchars($row['department']); ?>
                            </span>
                        </td>
                        <td><?php echo htmlspecialchars($row['designation']); ?></td>
                        <td>
                            <strong style="color: #2d3748;">
                                ₹<?php echo $salary; ?>
                            </strong>
                        </td>
                <?php
                }
                ?>
            </tbody>
        </table>
    </div>

    <!-- Footer Stats -->
    <div style="
        margin-top: 20px;
        padding-top: 20px;
        border-top: 2px solid #e2e8f0;
        display: flex;
        justify-content: space-between;
        align-items: center;
        flex-wrap: wrap;
        gap: 12px;
    ">
        <div style="color: #8b8fa7; font-size: 14px;">
            Showing <strong><?php echo $row_count; ?></strong> employee(s)
        </div>
        <div style="display: flex; gap: 16px; align-items: center;">
            <span style="color: #8b8fa7; font-size: 14px;">
                📋 Total Records: <strong><?php echo $row_count; ?></strong>
            </span>
            <a href="export.php" style="
                color: #667eea;
                text-decoration: none;
                font-weight: 600;
                font-size: 14px;
                transition: all 0.3s ease;
            ">
                📥 Export
            </a>
        </div>
    </div>

</div>

<!-- JavaScript for Search & Filter -->
<script>
    // Search functionality
    document.getElementById('searchInput').addEventListener('keyup', function() {
        const searchTerm = this.value.toLowerCase();
        const rows = document.querySelectorAll('.employee-row');
        
        rows.forEach(row => {
            const text = row.textContent.toLowerCase();
            row.style.display = text.includes(searchTerm) ? '' : 'none';
        });
    });

    // Filter by department
    document.getElementById('filterDept').addEventListener('change', function() {
        const dept = this.value;
        const rows = document.querySelectorAll('.employee-row');
        
        rows.forEach(row => {
            if (dept === '' || row.dataset.department === dept) {
                row.style.display = '';
            } else {
                row.style.display = 'none';
            }
        });
    });
</script>

</body>
</html>

<?php
mysqli_close($conn);
?>