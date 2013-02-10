<h3>Conexión de usuario</h3>

<p class="login_text">Correo Electrónico: </p>
<input type="email"  class="input_large" placeholder="Correo electrónico" id="email" />

<p class="login_text">Contraseña: </p>
<input type="password" class="input_large" placeholder="Contraseña" id="pass" />
<br />
<button class="button_green" onclick="loginUser($('#email').val(), $('#pass').val());">Conectar</button>