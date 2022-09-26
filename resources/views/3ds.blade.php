<h2>Сейчас вы будете перенапрелены на страницу оплаты</h2>

<form action="{{ $acsUrl }}" method="POST" id="hiddenForm">
    <input type=hidden name=PaReq value="{{ $pares }}">
    <input type=hidden name=TermUrl value="{{ $termUrl }}">
    <input type=hidden name=MD value="{{ $md }}">
</form>

<script>
    setTimeout( () => document.querySelector('#hiddenForm').submit() , 3000 )
</script>