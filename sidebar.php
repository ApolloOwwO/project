<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
<head>
    <style>
        .sidebar {
            display: flex;
            flex-direction: column;
            position: fixed;            
            width: 200px;
            height: 100%;
            background-color: #f5f5f5;
            padding: 20px;
            box-shadow: 2px 0 5px rgba(0,0,0,0.1);
        }
        body{
            flex-direction: row;
            display: flex;
        }

        .logo {
            font-size: 24px;
            margin-bottom: 40px;
            color: #333;
        }

        .sidebar-button {
            width: 100%;
            padding: 12px;
            margin-bottom: 10px;
            border: none;
            background: #fff;
            border-radius: 8px;
            cursor: pointer;
            transition: 0.3s;
            text-align: left;
        }

        .sidebar-button:hover {
            background: #e0e0e0;
            transform: translateX(5px);
        }

        .fa-clipboard, .fa-plus, .fa-xmark{
            margin-right: 10px;
        }
        .main-content {
            margin-left: 240px;
            padding: 20px;
        }

        .exit-button {           
            background-color: rgb(238, 17, 17);
            color: white;
            margin-top: auto;
            margin-bottom: 5rem;
        }

        .exit-button:hover {
            background-color: rgb(248, 62, 62);
            color: white;
        }
        .menu_wrapper{
            display: flex;
            flex-direction: column;
            flex-grow: 1;
        }

    </style>
</head>
<body>
        <div class="sidebar">
            <div class="logo">☕ Coffee Shop</div>
                <div class="menu_wrapper">
                    <button onclick="window.location.href='index.php'" class="sidebar-button"><i class="fa-regular fa-clipboard"></i> Menu</button>
                    <button onclick="window.location.href='products.php'" class="sidebar-button"><i class="fa-solid fa-plus"></i> Add Product</button>
                    <button onclick="confirmLogout()"class="sidebar-button exit-button"><i class="fa-solid fa-xmark"></i> Exit</button>
                </div>
        </div>    
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    function confirmLogout() {
        Swal.fire({
            title: "Are you sure?",
            text: "You will be logged out!",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#d33",
            cancelButtonColor: "#3085d6",
            confirmButtonText: "Yes, log me out!"
        }).then((result) => {
            if (result.isConfirmed) {
                window.location.href = "login.php"; // Redirects to logout page
            }
        });
    }
</script>
</body>