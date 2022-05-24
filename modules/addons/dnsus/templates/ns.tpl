<h1>nses</h1>
<div>
  <form action="">
    <input type="text" name="name" placeholder="name" id="name">
    <input type="text" name="ttl" placeholder="ttl" id="ttl">
    <input type="text" name="rtype" placeholder="type" id="rtype">
    <input type="text" name="ip" placeholder="ip" id="ip">
    <input type="text" name="domain" placeholder="domain" id="domain">
    <input type="text" name="priority" placeholder="priority" id="priority">
    <input type="text" name="email" placeholder="email" id="email">
    <input type="text" name="value" placeholder="value" id="value">
    <input type="text" name="weight" placeholder="weight" id="weight">
    <input type="text" name="port" placeholder="port" id="port">
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

  $('#ns_edit').on('click', function(){
    $.ajax({
      url:window.location.hostname+'/{$modulelink}',
      data:{
        cmd: 'edit_ns',

        "name" : $("#name"),
        "ttl" : $("#ttl"),
        "rtype" : $("#rtype"),
        "ip" : $("#ip"),
        "domain" : $("#domain"),
        "priority" : $("#priority"),
        "email" : $("#email"),
        "value" : $("#value"),
        "weight" : $("#weight"),
        "port" : $("#port"),
      },
      success: (msg) => {
        console.log(msg)
      },
      error: (msg) => {
        console.log(msg)
      }
    })
  })



</script>
