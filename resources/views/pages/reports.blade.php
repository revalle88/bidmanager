<link href="{{ asset('css/app.css') }}" rel="stylesheet">
<div class = "container">
<br>

<table class="table table-hover">
<thead>
                            <tr>
                                <!-- Task Name -->
                                <th>
                                   Кампания
                                </th>	
                                <th>
                                  Потрачено
                                </th>
								<th>
                                  Визиты
                                </th>
								<th>
                                  Цена за визит
                                </th>
                            </tr>
							</thead>
							<tr>
							  <td class="table-text">
                                   {{$campaignid}}
                                </td>	
                                <td>
                                  {{$cost}} руб.
                                </td>
								<td>
                                  {{$clicks}}
                                </td>
								<td>
                                  {{$clickcost}} руб.
                                </td>
							</tr>
</table>
{!! Form::open(array('url' => 'reports')) !!}
<input type = "hidden" name = "login" id = "login" value = "{{$login}}">
В период с <input name = "dateBeg" type = "date">
по <input name = "dateEnd" type = "date">
<input type = "submit" text = "ok" value = "посчитать">
{!! Form::close() !!}
</div>