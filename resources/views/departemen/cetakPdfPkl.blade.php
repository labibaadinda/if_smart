<body>

    <table style="background-color: white!important;">
        <style>
            body {
                -webkit-print-color-adjust: exact !important
            }

            .pertama {
                border: solid 1px
            }

            .kedua {
                border-top: solid 1px;
                border-bottom: solid 1px;
                border-left: solid 1px;
                border-right: solid 1px
            }

            .ketiga {
                border-top: solid 1px;
                border-bottom: solid 1px;
                border-left: solid 1px;
                border-right: none 1px;
                font-family: 'Times New Roman' !important
            }

            .keempat {
                border-top: solid 1px;
                border-bottom: solid 1px;
                border-left: none 1px;
                border-right: solid 1px;
                font-family: 'Times New Roman' !important
            }

            .kelima {
                border-top: solid 1px;
                border-bottom: solid 1px;
                border-left: none 1px;
                border-right: none 1px;
                font-family: 'Times New Roman' !important
            }
        </style>
        <tbody>
            <tr>
                <td>
                    <table style="min-width: 100%">
                        <thead style="text-align: center;">
                            <tr>
                                <th colspan="4"
                                    style="font-size: 26px;font-family:'Times New Roman'!important;padding: 0px;margin: 0px;">
                                    <b> Rekap Progress PKL Mahasiswa Informatika Fakultas Sains dan Matematika UNDIP Semarang</b></th>
                            </tr>
                            <tr>
                                <th colspan="2">&nbsp;</th>
                            </tr>
                        </thead>
                    </table>
                    <table style="min-width: 100%;font-size: 12px; font-family: 'Times New Roman'!important;">
                        <thead style="font-size: 12px;">
                            <tr style="text-align: center;height: 30px;">
                                <td></td>
                                @php
                                    $i = 0;
                                    foreach (range($thnmin->angkatan, $thnmax->angkatan) as $item)
                                        $i++;
                                    $i=$i*2
                                @endphp
                                <td style="width: 50px;background-color: #a9a9a99c;font-size: 20px;" class="pertama" colspan="{{ $i }}">
                                    <b ><strong>Angkatan</strong></b>
                                </td>
                                <td></td>
                            </tr>
                            <tr style="text-align: center;height: 30px;">
                                <td></td>


                                @foreach (range($thnmin->angkatan, $thnmax->angkatan) as $item)
                                    <td style="width: 50px;background-color: #a9a9a99c;" class="pertama" colspan="2">
                                        <b>{{ $item }}</b>
                                    </td>
                                @endforeach
                                <th></th>

                            </tr>
                            <tr style="text-align: center;height: 30px;">
                                <td></td>
                                @foreach (range($thnmin->angkatan, $thnmax->angkatan) as $item)
                                        <td style="width: 50px;background-color: #a9a9a99c;" class="pertama" ><b>Sudah</b></td>
                                        <td style="width: 50px;background-color: #a9a9a99c;" class="pertama" ><b>Belum</b></td>
                                    @endforeach
                                <td></td>

                            </tr>
                        </thead>
                        <tbody style="font-size: 12px;margin: 0;padding: 0;font-family: 'Times New Roman'!important;">
                            <tr>
                                <td></td>
                                @foreach ($angkatanArray as $angkatanItem => $jumlah)
                                    <td style="width: 50px;text-align: center;vertical-align: top;" class="kedua">
                                            {{ $jumlah['sudah_pkl'] }}
                                        </a>
                                    </td>
                                    <td style="width: 50px;text-align: center;vertical-align: top;" class="kedua">
                                            {{ $jumlah['belum_pkl'] }}
                                        </a>
                                    </td>
                                @endforeach
                                <td></td>
                            </tr>
                        </tbody>
                    </table>

                </td>
            </tr>
        </tbody>
    </table>


</body>
