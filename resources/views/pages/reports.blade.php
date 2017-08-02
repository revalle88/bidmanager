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
                                  {{$cost}}
                                </td>
								<td>
                                  {{$clicks}}
                                </td>
								<td>
                                  {{$clickcost}}
                                </td>
							</tr>
</table>
{!! Form::open(array('url' => 'reports')) !!}
<input type = "text" name = "login" id = "login" value = "{{$login}}">
<input name = "dateBeg" type = "date">
<input name = "dateEnd" type = "date">
<input type = "submit" text = "ok">
{!! Form::close() !!}
</div>