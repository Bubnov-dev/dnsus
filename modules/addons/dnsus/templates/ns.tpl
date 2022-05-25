<style>
    .hidden{
        display: none;
    }
</style>
<h1>nses</h1>
<div>
    <form class="dns-form" action="">
        <input type="text" name="name" placeholder="name" id="name">

        <input type="text" name="ttl" placeholder="ttl" id="ttl">
        <select name="rtype" id="rtype">
            <option value="a">A</option>
            <option value="aaaa">AAAA</option>
            <option value="txt">TXT</option>
            <option value="cname">CNAME</option>
            <option value="ns">NS</option>
            <option value="mx">MX</option>
            <option value="srv">SRV</option>
            <option value="soa">SOA</option>
        </select>

        <div class="input-to-hide input-wrapper-ip">
            <input type="text" name="ip" placeholder="ip" id="ip">
        </div>

        <div class="input-to-hide input-wrapper-domain">
            <input type="text" name="domain" placeholder="domain" id="domain"></div>

        <div class="input-to-hide input-wrapper-srvdomain">
            <input type="text" name="srvdomain" placeholder="srvdomain" id="srvdomain"></div>

        <div class="input-to-hide input-wrapper-priority">
            <input type="text" name="priority" placeholder="priority" id="priority"></div>

        <div class="input-to-hide input-wrapper-value">
            <input type="text" name="value" placeholder="value" id="value"></div>

        <div class="input-to-hide input-wrapper-weight">
            <input type="text" name="weight" placeholder="weight" id="weight"></div>

        <div class="input-to-hide input-wrapper-port">
            <input type="text" name="port" placeholder="port" id="port"></div>


        <div class="input-to-hide input-wrapper-email">

            <input type="text" name="email" placeholder="email" id="email"></div>
        <br><br>
        <input type="text" name="elid" placeholder="elid" id="elid">
        <input type="text" name="plid" placeholder="plid" id="plid" value="{$plid}">

    </form>
    <button id="edit_ns">Редактировать</button>
    <button id="add_ns">Добавить</button>
</div>
<table class="table">
    <thead>
    <td>rkey</td>
    <td>rkey_name</td>
    <td>name</td>
    <td>ttl</td>
    <td>rtype</td>
    <td>rtype_hidden</td>
    <td>value</td>
    <td>info</td>

    </thead>
    {foreach $nses as $ns}
        <tr>
            <td>
                {$ns['rkey']}
            </td>
            <td>
                {$ns['rkey_name']}
            </td>
            <td>
                {$ns['name']}
            </td>
            <td>
                {$ns['ttl']}
            </td>
            <td>
                {$ns['rtype']}
            </td>
            <td>
                {$ns['rtype_hidden']}
            </td>
            <td>
                {$ns['value']}
            </td>

            <td>
                {$ns['info']}
            </td>
        </tr>
    {/foreach}
</table>

<script>

    $('#edit_ns').on('click', function () {
        $.ajax({
            url: window.location.hostname + '/{$modulelink}',
            method: 'POST',
            data: {
                cmd: 'edit_ns',

                "elid": encodeURI($("#elid").val()),
                "ttl": encodeURI($("#ttl").val()),
                "rtype": encodeURI($("#rtype").val()),
                "ip": encodeURI($("#ip").val()),
                "domain": encodeURI($("#domain").val()),
                "srvdomain": encodeURI($("#srvdomain").val()),

                "name": encodeURI($("#name").val()),
                "priority": encodeURI($("#priority").val()),
                "email": encodeURI($("#email").val()),
                "value": encodeURI($("#value").val()),
                "weight": encodeURI($("#weight").val()),
                "port": encodeURI($("#port").val()),
            },
            success: (msg) => {
                console.log(msg)
            },
            error: (msg) => {
                console.log(msg)
            }
        })
    })

    $('#add_ns').on('click', function () {
        $.ajax({
            url: window.location.hostname + '/{$modulelink}',
            method: 'POST',
            data: {
                cmd: 'add_ns',

                "elid": '',
                "plid" :encodeURI($('#plid').val()),
                "ttl": encodeURI($("#ttl").val()),
                "rtype": encodeURI($("#rtype").val()),
                "ip": encodeURI($("#ip").val()),
                "domain": encodeURI($("#domain").val()),
                "srvdomain": encodeURI($("#srvdomain").val()),
                "name": encodeURI($("#name").val()),
                "priority": encodeURI($("#priority").val()),
                "email": encodeURI($("#email").val()),
                "value": encodeURI($("#value").val()),
                "weight": encodeURI($("#weight").val()),
                "port": encodeURI($("#port").val()),
            },
            success: (msg) => {
                console.log(msg)
            },
            error: (msg) => {
                console.log(msg)
            }
        })
    })

    let types = {
        A: ['ip'],
        AAAA: ['ip'],
        TXT: ['value'],
        CNAME: ['domain'],
        NS: ['domain'],
        MX: ['domain', 'priority'],
        SRV: ['srvdomain', 'priority', 'weight', 'port'],
        SOA: ['email']
    }

    let chosen_type = 'A';

    $('#rtype').on('change', function() {
        showInputs()
    })


    var showInputs = function() {
        chosen_type = $('#rtype').val().toUpperCase()
        $('.dns-form .input-to-hide').addClass('hidden');

        types[chosen_type].forEach(el => {
            $('.input-wrapper-' + el).removeClass('hidden');
        })


    }


</script>
