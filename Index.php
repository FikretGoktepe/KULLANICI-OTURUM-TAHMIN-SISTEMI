<!DOCTYPE html>
<html lang="tr">

<head>
    <meta charset="UTF-8" />
    <title>Kullanıcı Listesi</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@tabler/core@1.3.2/dist/css/tabler.min.css">
    <style>
        .card {
            max-width: 100%;
            margin: 5%;
            margin-top: 10%;
            margin-bottom: 10%;
            padding: 0 20px;
        }

        .table-responsive {
            overflow-x: auto;
        }
    </style>
</head>

<body>
    <div class="card">
        <div class="table-responsive">
            <table id="userTable" class="table table-vcenter card-table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Ad</th>
                        <th>Tahmini Zaman 1</th>
                        <th>Tahmini Zaman 2 (Hafta, Saat)</th>
                    </tr>
                </thead>
                <tbody>

                </tbody>
            </table>
        </div>
    </div>

    <script>
        function dayNumberToName(dayNum) {
            switch (dayNum) {
                case 1:
                    return "Monday";
                case 2:
                    return "Tuesday";
                case 3:
                    return "Wednesday";
                case 4:
                    return "Thursday";
                case 5:
                    return "Friday";
                case 6:
                    return "Saturday";
                case 7:
                    return "Sunday";
                default:
                    return "";
            }
        }

        fetch('Controller.php')
            .then(response => response.json())
            .then(data => {
                const tbody = document.querySelector('#userTable tbody');
                tbody.innerHTML = '';

                data.forEach(user => {
                    let week = '';
                    let hour = '';
                    if (Array.isArray(user.averageHour2)) {
                        week = user.averageHour2[0] !== null && user.averageHour2[0] !== undefined ? dayNumberToName(Number(user.averageHour2[0])) : '';
                        hour = user.averageHour2[1] !== null && user.averageHour2[1] !== undefined ? user.averageHour2[1] : '';
                    }

                    const tr = document.createElement('tr');
                    tr.innerHTML = `
                <td>${user.id}</td>
                <td>${user.name}</td>
                <td>${user.averageHour1}</td>
                <td>${week}, ${hour}</td>
            `;
                    tbody.appendChild(tr);
                });
            })
            .catch(console.error);
    </script>

    <script src="https://cdn.jsdelivr.net/npm/@tabler/core@1.3.2/dist/js/tabler.min.js"></script>
</body>

</html>