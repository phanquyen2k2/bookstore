@extends('Admin.LayoutAdmin');
@section('content')
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Responsive Admin Dashboard | Korsat X Parmaga</title>
    <style>
        /* CSS code như bạn đã cung cấp */
               /* =========== Google Fonts ============ */
@import url("https://fonts.googleapis.com/css2?family=Ubuntu:wght@300;400;500;700&display=swap");

/* =============== Globals ============== */
* {
  
  margin: 0;
  padding: 0;
  box-sizing: border-box;
}

:root {
  --blue: #2a2185;
  --white: #fff;
  --gray: #f5f5f5;
  --black1: #222;
  --black2: #999;
}

body {
  min-height: 100vh;
  overflow-x: hidden;
}

.container {
  position: relative;
  width: 100%;
}



/* ===================== Main ===================== */
.main {
  position: absolute;
  width: calc(100% - 300px);
  left: 300px;
  min-height: 100vh;
  background: var(--white);
  transition: 0.5s;
}
.main.active {
  width: calc(100% - 80px);
  left: 80px;
}

.topbar {
  width: 100%;
  height: 60px;
  display: flex;
  justify-content: space-between;
  align-items: center;
  padding: 0 10px;
}

.toggle {
  position: relative;
  width: 60px;
  height: 60px;
  display: flex;
  justify-content: center;
  align-items: center;
  font-size: 2.5rem;
  cursor: pointer;
}

.search {
  position: relative;
  width: 400px;
  margin: 0 10px;
}

.search label {
  position: relative;
  width: 100%;
}

.search label input {
  width: 100%;
  height: 40px;
  border-radius: 40px;
  padding: 5px 20px;
  padding-left: 35px;
  font-size: 18px;
  outline: none;
  border: 1px solid var(--black2);
}

.search label ion-icon {
  position: absolute;
  top: 0;
  left: 10px;
  font-size: 1.2rem;
}

.user {
  position: relative;
  width: 40px;
  height: 40px;
  border-radius: 50%;
  overflow: hidden;
  cursor: pointer;
}

.user img {
  position: absolute;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  object-fit: cover;
}

/* ======================= Cards ====================== */
.cardBox {
  position: relative;
  width: 100%;
  padding: 20px;
  display: grid;
  grid-template-columns: repeat(4, 1fr);
  grid-gap: 30px;
}

.cardBox .card {
  position: relative;
  background: var(--white);
  padding: 30px;
  border-radius: 20px;
  display: flex;
  justify-content: space-between;
  cursor: pointer;
  box-shadow: 0 7px 25px rgba(0, 0, 0, 0.08);
}

.cardBox .card .numbers {
  position: relative;
  font-weight: 500;
  font-size: 2.5rem;
  color: var(--blue);
}

.cardBox .card .cardName {
  color: var(--black2);
  font-size: 1.1rem;
  margin-top: 5px;
}

.cardBox .card .iconBx {
  font-size: 3.5rem;
  color: var(--black2);
}



/* ================== Order Details List ============== */
.details {
  position: relative;
  width: 100%;
  padding: 20px;
  display: grid;
  grid-template-columns: 2fr 1fr;
  grid-gap: 30px;
  /* margin-top: 10px; */
}

.cardHeader {
  margin-bottom: 30px;
}

.cardHeader h2 {
  margin: 0;
  padding: 0;
}

.recentOrders table {
  margin-top: 0;
}

.details .recentOrders {
  position: relative;
  display: grid;
  min-height: 500px;
  background: var(--white);
  padding: 20px;
  box-shadow: 0 7px 25px rgba(0, 0, 0, 0.08);
  border-radius: 20px;
}

.details .cardHeader {
  display: flex;
  justify-content: space-between;
  align-items: flex-start;
}

.cardHeader h2 {
  font-weight: 600;
  color: var(--blue);
}

.cardHeader .btn {
  position: relative;
  padding: 5px 10px;
  background: var(--blue);
  text-decoration: none;
  color: var(--white);
  border-radius: 6px;
}

.details table {
  width: 100%;
  border-collapse: collapse;
  margin-top: -120px;
}

.details table thead td {
  font-weight: 600;
}

.details .recentOrders table tr {
  color: var(--black1);
  border-bottom: 1px solid rgba(0, 0, 0, 0.1);
}

.details .recentOrders table tr:last-child {
  border-bottom: none;
}
.details .recentOrders table tr td {
  padding: 10px;
}

.details .recentOrders table tr td:last-child {
  text-align: end;
}

.details .recentOrders table tr td:nth-child(2) {
  text-align: end;
}

.details .recentOrders table tr td:nth-child(3) {
  text-align: center;
}

.status {
  padding: 2px 4px;
  color: var(--white);
  border-radius: 4px;
  font-size: 14px;
  font-weight: 500;
}

.status.delivered {
  background: #8de02c;
}

.status.pending {
  background: #e9b10a;
}

.status.return {
  background: #f00;
}

.status.inProgress {
  background: #1795ce;
}

.status.paid {
  background: #0099ff; /* Green color for paid status */
}
.status.processing {
  background: #ba03fd; /* Green color for paid status */
}

.status.cancelled {
  background: #ff1100; /* Red color for unpaid status */
}
.status.completed {
  background: #00ff26; /* Red color for unpaid status */
}


.recentCustomers {
  position: relative;
  display: grid;
  min-height: 80px;
  padding: 10px 10px; /* Thay đổi giá trị padding */
  background: var(--white);
  box-shadow: 0 7px 25px rgba(0, 0, 0, 0.08);
  border-radius: 20px;
}

.recentCustomers table {
  margin-bottom: 200px; /* Tăng khoảng cách giữa table và phần dưới */
}

.recentCustomers .imgBx {
  position: relative;
  width: 40px;
  height: 40px;
  border-radius: 50px;
  overflow: hidden;
}

.recentCustomers .imgBx img {
  position: absolute;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  object-fit: cover;
}

.recentCustomers table tr td {
  padding: 12px 10px;
}

.recentCustomers table tr td h4 {
  font-size: 16px;
  font-weight: 500;
  line-height: 1.2rem;
}

.recentCustomers table tr td h4 span {
  font-size: 14px;
  color: var(--black2);
}
/* ====================== Responsive Design ========================== */
@media (max-width: 991px) {
  .navigation {
    left: -300px;
  }
  .navigation.active {
    width: 300px;
    left: 0;
  }
  .main {
    width: 100%;
    left: 0;
  }
  .main.active {
    left: 300px;
  }
  .cardBox {
    grid-template-columns: repeat(2, 1fr);
  }
}

@media (max-width: 768px) {
  .details {
    grid-template-columns: 1fr;
  }
  .recentOrders {
    overflow-x: auto;
  }
  .status.inProgress {
    white-space: nowrap;
  }
}

@media (max-width: 480px) {
  .cardBox {
    grid-template-columns: repeat(1, 1fr);
  }
  .cardHeader h2 {
    font-size: 20px;
  }
  .user {
    min-width: 40px;
  }
  .navigation {
    width: 100%;
    left: -100%;
    z-index: 1000;
  }
  .navigation.active {
    width: 100%;
    left: 0;
  }
  .toggle {
    z-index: 10001;
  }
  .main.active .toggle {
    color: #fff;
    position: fixed;
    right: 0;
    left: initial;
  }
}

    </style>
</head>

<body>
  <div class="container">
    <!-- ======================= Cards ================== -->
    <div class="cardBox">
        <div class="card">
            <div>
                <div class="numbers">{{ $totalOrders }}</div>
                <div class="cardName">Total Orders</div>
            </div>
            <div class="iconBx">
                <ion-icon name="receipt-outline"></ion-icon>
            </div>
        </div>

        <div class="card">
            <div>
                <div class="numbers">{{ $totalProducts }}</div>
                <div class="cardName">Total Products</div>
            </div>
            <div class="iconBx">
                <ion-icon name="book-outline"></ion-icon>
            </div>
        </div>

        <div class="card">
            <div>
                <div class="numbers">{{ $totalUsers }}</div>
                <div class="cardName">Total Users</div>
            </div>
            <div class="iconBx">
                <ion-icon name="people-outline"></ion-icon>
            </div>
        </div>

        <div class="card">
            <div>
                <div class="numbers">{{ number_format($totalEarnings) }}đ</div>
                <div class="cardName">Total Earnings</div>
            </div>
            <div class="iconBx">
                <ion-icon name="cash-outline"></ion-icon>
            </div>
        </div>
    </div>

    <!-- ================ Order Details List ================= -->
    <div class="details">
      <div class="recentOrders">
          <div class="cardHeader">
              <h2>Recent Orders</h2>
              <a href="{{ route("orderlist") }}" class="btn">View All</a>
          </div>
          <table>
              <thead>
                  <tr>
                      <td>Name</td>
                      <td>Price</td>
                      <td>Payment</td>
                      <td>Status</td>
                  </tr>
              </thead>

              <tbody>
                  @foreach($orders as $order)
                      <tr>
                          <td>{{ $order->name }}</td>
                          <td>{{ number_format($order->total_price) }}đ</td>
                          <td>{{ $order->payment_method }}</td>
                          <td><span class="status {{ strtolower(str_replace(' ', '', $order->status)) }}">{{ $order->status }}</span></td>
                      </tr>
                  @endforeach
              </tbody>
          </table>
      </div>
        
        <!-- ================ Recent Customers ================ -->
        <div class="recentCustomers">
            <div class="cardHeader">
                <h2>Top Buyers</h2>
            </div>
            <table style="margin-top: 2px">
                @forelse($topBuyers as $buyer)
                    <tr>
                        <td width="50px">
                            <div class="imgBx">
                                <img src="{{ $buyer->profile_photo_path ? asset('storage/' . $buyer->profile_photo_path) : 'https://upload.wikimedia.org/wikipedia/commons/9/99/Sample_User_Icon.png' }}" alt="Profile Picture">
                            </div>
                        </td>
                        <td>
                            <h4>{{ $buyer->name }}</h4>
                            <p>Total Orders: {{ $buyer->order_count  }}</p>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="2" class="text-center">No top buyers found.</td>
                    </tr>
                @endforelse
            </table>
        </div>
        <!-- Top Selling Products section -->
        <div class="details">
          <div class="recentOrders">
              <div class="cardHeader">
                  <h2>Top Selling Products</h2>
                  <a href="{{ route("orderlist") }}" class="btn">View All</a>
              </div>
              <table style="margin-top:1px ">
                  <thead>
                      <tr>
                        <td>Name</td>
                        <td>Total Sold</td>
                      </tr>
                  </thead>
    
                  <tbody>
                    @foreach($topSellingProducts as $sell)
                    <tr>
                        <td>{{ $sell->product_name }}</td>
                        <td>{{ $sell->total_quantity }}</td>
                    </tr>
                @endforeach
                  </tbody>
              </table>
          </div>
        {{--  --}}
   




    <!-- ====== ionicons ======= -->
    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
</body>

</html>

@endsection