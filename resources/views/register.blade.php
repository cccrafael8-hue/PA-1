<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Register | AGATHA SPACE</title>
<link href="https://fonts.googleapis.com/css2?family=Allura&family=DM+Sans:wght@300;400;500&display=swap" rel="stylesheet">
<style>
*{margin:0;padding:0;box-sizing:border-box}
body{
  min-height:100vh;
  font-family:'DM Sans',sans-serif;
  display:flex;
  align-items:center;
  justify-content:center;
  padding:2rem;
  background:
    linear-gradient(rgba(26,17,12,0.82), rgba(26,17,12,0.82)),
    url('https://images.unsplash.com/photo-1495474472287-4d71bcdd2085?q=80&w=2070&auto=format&fit=crop') center/cover no-repeat;
}
.card{
  background:#fff;
  width:100%;
  max-width:440px;
  border-radius:16px;
  overflow:hidden;
  box-shadow:0 24px 60px rgba(0,0,0,0.35);
}
.card-top{
  background:#2A1A12;
  padding:36px 40px 28px;
  text-align:center;
  position:relative;
}
.card-top::after{
  content:'';
  position:absolute;
  bottom:0;left:50%;transform:translateX(-50%);
  width:40px;height:2px;
  background:#B8942B;
}
.brand-script{
  font-family:'Allura',cursive;
  font-size:62px;
  color:#D4B253;
  line-height:1;
  display:block;
}
.brand-tagline{
  font-size:10px;
  letter-spacing:5px;
  text-transform:uppercase;
  color:rgba(212,178,83,0.5);
  margin-top:4px;
}
.card-body{
  padding:36px 40px 40px;
}
.section-label{
  font-size:11px;
  letter-spacing:3px;
  text-transform:uppercase;
  color:#B8942B;
  margin-bottom:24px;
  display:flex;
  align-items:center;
  gap:10px;
}
.section-label::before,.section-label::after{
  content:'';flex:1;height:1px;background:#EEE;
}
.field{
  margin-bottom:18px;
}
.field label{
  display:block;
  font-size:11px;
  font-weight:500;
  letter-spacing:1px;
  text-transform:uppercase;
  color:#888;
  margin-bottom:7px;
}
.field input{
  width:100%;
  padding:12px 16px;
  border:1.5px solid #E8E3DB;
  border-radius:8px;
  font-family:'DM Sans',sans-serif;
  font-size:14px;
  color:#1A110C;
  outline:none;
  transition:border-color 0.25s, box-shadow 0.25s;
  background:#FDFBF7;
}
.field input:focus{
  border-color:#B8942B;
  box-shadow:0 0 0 3px rgba(184,148,43,0.1);
  background:#fff;
}
.field input::placeholder{color:#C8C3BB}
.row{display:grid;grid-template-columns:1fr 1fr;gap:14px}
.btn{
  width:100%;
  padding:14px;
  background:#2A1A12;
  color:#D4B253;
  border:none;
  border-radius:8px;
  font-family:'DM Sans',sans-serif;
  font-size:12px;
  letter-spacing:3px;
  text-transform:uppercase;
  font-weight:500;
  cursor:pointer;
  margin-top:6px;
  transition:background 0.2s, transform 0.1s;
}
.btn:hover{background:#3D2B20}
.btn:active{transform:scale(0.99)}
.footer{
  text-align:center;
  margin-top:22px;
  font-size:13px;
  color:#AAA;
}
.footer a{color:#B8942B;text-decoration:none;font-weight:500;border-bottom:1px solid rgba(184,148,43,0.3)}
.footer a:hover{border-bottom-color:#B8942B}
.error{
  background:#FEF2F2;
  border-left:3px solid #EF4444;
  color:#B91C1C;
  font-size:13px;
  padding:10px 14px;
  border-radius:0 6px 6px 0;
  margin-bottom:18px;
}
</style>
</head>
<body>
<div class="card">
  <div class="card-top">
    <span class="brand-script">Agatha</span>
    <span class="brand-tagline">Space</span>
  </div>

  <div class="card-body">
    <div class="section-label">Buat Akun</div>

    @if($errors->any())
      <div class="error">{{ $errors->first() }}</div>
    @endif 

    <form method="POST" action="{{ route('register') }}">
      @csrf

      <div class="field">
        <label>Nama</label>
        <input type="text" name="name" value="{{ old('name') }}" placeholder="Nama lengkap" required>
      </div>
      <div class="field">
        <label>Email</label>
        <input type="email" name="email" value="{{ old('email') }}" placeholder="email@contoh.com" required>
      </div>
      <div class="row">
        <div class="field">
          <label>Password</label>
          <input type="password" name="password" placeholder="••••••••" required>
        </div>
        <div class="field">
          <label>Konfirmasi</label>
          <input type="password" name="password_confirmation" placeholder="••••••••" required>
        </div>
      </div>
      <button type="submit" class="btn">Daftar Sekarang</button>
    </form>

    <p class="footer">Sudah punya akun? <a href="{{ route('login') }}">Login di sini</a></p>
  </div>
</div>
</body>
</html>