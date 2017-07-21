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

Выберите клиента:
<table>
   @foreach ($logins->data as $login)
                            <tr>
                                <!-- Task Name -->
                                <td class="table-text">
								
                                  <div> <a href = "{{ route('compains', $login->Login)}}">{{$login->Login}}</a></div>
                                </td>

                                <td>
                                    <div>{{ $login->FIO }}</div>
                                </td>
                            </tr>
    @endforeach
</table>