<style>
    ::-webkit-scrollbar {
    width: 8px;
    }

    ::-webkit-scrollbar-thumb {
    background-color: #ccc;
    border-radius: 10px;
    }
    #aetiqueta:hover {
        background: #ccc !important;
        text-decoration: none;
        color: inherit;
    }


</style>
<li class="nav-item dropdown">
    <link href="assets/css/apps/notes.css" rel="stylesheet" type="text/css" />
    <a class="nav-link" href="http://example.com" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        <i class="material-icons">notifications</i>
        @if (count(auth()->user()->unreadNotifications))
        <span class="badge badge-warning">{{ count(auth()->user()->unreadNotifications) }}</span>
        @endif
    </a>
    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownMenuLink" style="width:350px; height: 500px; overflow-y: auto;">
        <table>
            <tr>
                <td>
                    <span class="dropdown-header">Notificaciones Sin Leer</span>
                </td>
                <td>
                    <a href="{{ route('markAsRead') }}" class="dropdown-item dropdown-footer">Marcar Todos LEÍDOS</a>
                </td>
            </tr>
        </table>
        @forelse (auth()->user()->unreadNotifications as $notification)
            @if ($notification->type === 'App\Notifications\PensionNotification')
            <a href="{{ route('admin.pensionado.listpensionados') }}" class="dropdown-item">
                <i class="fa-solid fa-check-double"></i> Pensión {{ $notification->data['id'] }}
                <span class="ml-3 float-right text-muted text-sm">{{ $notification->created_at->diffForHumans() }}</span>
            </a>
            @elseif ($notification->type === 'App\Notifications\ProblemaRegistradoNotification')
                <a href="{{ route('hostal.problemas.listproblem') }}" class="dropdown-item" id="aetiqueta">
                    <table style="width: 100%;">
                        <tr>
                            <td>
                                <i class="fas fa-exclamation-triangle mr-2"> Nuevo problema registrado:</i> 
                            </td>                           
                        </tr>
                        <tr>
                            <td>
                                <span>{{ $notification->data['problema_titulo'] }}</span>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                @if (isset($notification->data['user']))
                                    <span>{{ $notification->data['user'] }}</span>
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <span class="ml-3 float-right text-muted text-sm">{{ $notification->created_at->diffForHumans() }}</span>
                            </td>
                        </tr>
                    </table>
                </a>
            @elseif ($notification->type === 'App\Notifications\ProblemaSolucionadoNotification' )
                <a href="{{ route('hostal.problemas.listproblem') }}" class="dropdown-item" id="aetiqueta">
                    <table style="width: 100%;">
                        <tr>
                            <td>
                            <i class="fa fa-check" aria-hidden="true"> Problema Solucionado:</i>
                            </td>                           
                        </tr>
                        <tr>
                            <td>
                                <span>{{ $notification->data['solution'] }}</span>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                @if (isset($notification->data['user']))
                                    <span>{{ $notification->data['user'] }}</span>
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <td style="margin-left: 50%;">
                                <span class="ml-3 float-right text-muted text-sm">{{ $notification->created_at->diffForHumans() }}</span>
                            </td>
                        </tr>
                    </table>
                </a>
            @endif
        @empty
            <span class="dropdown-item ml-3 text-muted text-sm">Sin notificaciones por leer</span> 
        @endforelse
        <div class="dropdown-divider"></div>
        <div class="dropdown-divider"></div>
        <span class="dropdown-header">Notificaciones Leídas</span>
        @forelse (auth()->user()->readNotifications as $notification)
            @if ($notification->type === 'App\Notifications\PensionNotification')
                <a href="{{ route('admin.pensionado.listpensionados') }}" class="dropdown-item">
                    <span class="ml-3 float-right text-muted text-sm">{{ $notification->created_at->diffForHumans() }}</span>
                </a>
            @elseif ($notification->type === 'App\Notifications\ProblemaRegistradoNotification')
                <a href="{{ route('hostal.problemas.listproblem') }}" class="dropdown-item">
                    <i class="fa-solid fa-check-double"></i> Problema : {{ $notification->data['problema_titulo'] }}
                    <span class="ml-3 float-right text-muted text-sm">{{ $notification->created_at->diffForHumans() }}</span>
                </a>
            @endif
        @empty
            <span class="dropdown-item ml-3 text-muted text-sm">Sin notificaciones leídas</span>
        @endforelse
    </div>
</li> 