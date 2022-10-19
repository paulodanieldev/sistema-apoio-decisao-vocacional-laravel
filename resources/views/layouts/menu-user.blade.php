<div class="menu">
    <div class="main-menu">
        <div class="scroll">
            <ul class="list-unstyled">

                <li>
                    <a href="{{ url('/user/agenda') }}">
                        <i class="simple-icon-event"></i>
                        <span>Agenda</span>
                    </a>
                </li>

                <li>
                    <a href="#dashboard">
                        <i class="iconsminds-building"></i>
                        <span>Propriedade</span>
                    </a>
                </li>

                <li>
                    <a href="{{ url('/user/procedimento') }}">
                        <i class="iconsminds-files"></i>
                        <span>Procedimentos</span>
                    </a>
                </li>

                <li>
                    <a href="{{ url('/user/treinamento') }}">
                        <i class="iconsminds-student-male-female"></i>
                        <span>Treinamentos</span>
                    </a>
                </li>

                {{-- <li>
                    <a href="{{ url('/user/relatorio') }}">
                        <i class="iconsminds-monitor-analytics"></i>
                        <span>Relatórios</span>
                    </a>
                </li> --}}

                {{-- <li>
                    <a href="#" target="_blank">
                        <i class="iconsminds-library"></i> Docs
                    </a>
                </li> --}}
            </ul>
        </div>
    </div>

    <div class="sub-menu">
        <div class="scroll">

            <ul class="list-unstyled" data-link="dashboard">
                {{-- <li>
                    <a href="{{ url('user/animais') }}">
                        <i class="iconsminds-cow"></i> <span class="d-inline-block">Animais</span>
                    </a>
                </li> --}}
                <li>
                    <a href="{{ url('user/propriedades') }}">
                        <i class="iconsminds-home-4"></i> <span class="d-inline-block">Propriedades</span>
                    </a>
                </li>
                <li>
                    <a href="{{ url('user/avaliacoesINs') }}">
                        <i class="iconsminds-pen-2"></i> <span class="d-inline-block">Minhas avaliações</span>
                    </a>
                </li>
                <li>
                    <a href="{{ url('user/producaoLeite') }}">
                        <i class="iconsminds-bucket"></i> <span class="d-inline-block">Leite produzido</span>
                    </a>
                </li>
                <li>
                    <a href="{{ url('user/producaoLeiteEntregue') }}">
                        <i class="iconsminds-check"></i> <span class="d-inline-block">Leite entregue</span>
                    </a>
                </li>
                <li>
                    <a href="{{ url('user/producaoLeiteIndices') }}">
                        <i class="iconsminds-monitor-analytics"></i> <span class="d-inline-block">Índices de produção</span>
                    </a>
                </li>
            </ul>
        </div>
    </div>
</div>
