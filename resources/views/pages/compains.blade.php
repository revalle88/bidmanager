<table>
   @foreach ($campaigns as $cmp)
                            <tr>
                                <!-- Task Name -->
                                <td class="table-text">
								
                                  <div> {{$cmp->Name}}</div>
                                </td>

                                <td>
                                    <div>{{ $cmp->StartDate }}</div>
                                </td>
                            </tr>
    @endforeach
</table>