<!--CONNECT PANEL
<ul>
<li>
<a href = "{{ route('connect') }}">Получить данные по клиенту</a>
</li>
<li>
<a href = "{{ route('subclients') }}">логины агенства</a>
</li>


<div class="form-group">
 
  <select class="form-control" name="item_id">
    @foreach ($logins->data as $login)
      <option value="{{ $login->Login }}">{{ $login->Login }}</option>
    @endforeach
  </select>
</div>-->
<link href="{{ asset('css/app.css') }}" rel="stylesheet">
<div class="container">
Выберите клиента:<br><br>
<!--<table>
   @foreach ($logins->data as $login)
                            <tr>
                               
                                <td class="table-text">
								
                                  <div> <a href = "{{ route('reports', $login->Login)}}">{{$login->Login}}</a></div>
                                </td>

                                <td>
                                    <div>{{ $login->FIO }}</div>
                                </td>
                            </tr>
							
							
    @endforeach
</table>
-->

   {!! Form::open(array('url' => 'reports')) !!}
      @foreach ($logins->data as $login)
	  <div class="form-group">
 <input type="radio" name="login" value="{{$login->Login}}">{{$login->FIO }}<Br>
 </div>



   @endforeach
<input type = "submit" text = "ok">
 {!! Form::close() !!}
 
 </div>
