<link href="{{ asset('css/app.css') }}" rel="stylesheet">
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

<input id = "dateBeg" type = "date">
<input id = "dateEnd" type = "date">
<input type = "submit" text = "ok">
