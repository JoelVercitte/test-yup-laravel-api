# teste-yup-laravel
API em Laravel, Interface Web em Vue.js e Ambiente Docker;<br>

# Interface Web
index.php ao inves de index.blade.php para não obter acesso direto na API;<br>

# Instruções de instalação
Tenha as portas 8088, 4306 e 9000 disponivel...<br>
Caso não seja possivel liberar as portas, troque-as em docker-compose.yml localizado na raiz;<br>
Lembrando que é necessario mudar as portas no .env; <br>
Abra um terminal dentro da raiz, e execute "docker-compose up -d";<br>
Acesse o localhost:8088;<br>

# Experiencia
60% do tempo foi usado para aprender a usar o Docker e Vue.Js;<br>
Já tinha experiencia com as outras ferramentas;<br>

# Teste

execute php artisan test na pasta src<br>

saída: <br>

<br>
 PASS  Tests\Unit\EspMedsTest<br>
  ✓ get all esp meds<br>
  ✓ get id esp meds<br>
<br>
   PASS  Tests\Unit\EspecialidadeTest<br>
  ✓ get all especialidade<br>
  ✓ get id especialidade<br>
<br>
   PASS  Tests\Unit\ExampleTest<br>
  ✓ basic test<br>
<br>
   PASS  Tests\Unit\MedicoTest<br>
  ✓ get all medico<br>
  ✓ get id medico<br>
<br>
   PASS  Tests\Unit\TelefoneTest<br>
  ✓ get all telefone<br>
  ✓ get id telefone<br>
<br>
   PASS  Tests\Feature\ExampleTest<br>
  ✓ basic test<br>
<br>
  Tests:  10 passed<br>
  Time:   0.63s<br>
