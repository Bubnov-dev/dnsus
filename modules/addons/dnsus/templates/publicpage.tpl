<h2>Public Client Area Sample Page</h2>

<p>This is an example of a public client area page that does not require a login to view.</p>

<p>All the template variables you define along with some <a href="https://developers.whmcs.com/themes/variables/"
                                                            target="_blank">additional standard template variables</a>
  are available within this template.<br>You can use the Smarty <em>{ldelim}debug{rdelim}</em> function call to see a
  full list.</p>

<hr>

<div class="row">
  <div class="col-sm-3">
    Module Link
  </div>
  <div class="col-sm-7">
      {$modulelink}
  </div>
</div>

<div class="row">
  <div class="col-sm-3">
    Config Text Field Value
  </div>
  <div class="col-sm-7">
      {$configTextField}
  </div>
</div>

<div class="row">
  <div class="col-sm-3">
    Custom Variable
  </div>
  <div class="col-sm-7">
      {$customVariable}
  </div>
</div>

<input type="text" name="name" id="name">
<button id="add_domain">Добавить домен</button>
<button id="delete_domain">Удалить домен</button>

<hr>

<p>
  <a href="{$modulelink}&action=secret" class="btn btn-default">
    <i class="fa fa-lock"></i>
    Go to page that requires authentication
  </a>
</p>
<script>


  $('#add_domain').click(function () {
    $.ajax({
      url:  location.href,
      method: 'post',
      dataType: 'json',
      data: {
        cmd: 'add_domain',
        name: $('#name').val()
      },
      success: (msg)  =>{
        console.log(msg)
      },
      error : (msg)  =>{
        console.log(msg)
      }
   })
  })

  $('#delete_domain').click(function () {
    $.ajax({
      url:  location.href,
      method: 'POST',
      dataType: 'json',
      data: {
        cmd: 'delete_domain',
        name: $('#name').val()
      },
      success: (msg)  =>{
        console.log(msg)
      },
      error : (msg)  =>{
        console.log(msg)
      }
    })

  })
</script>
