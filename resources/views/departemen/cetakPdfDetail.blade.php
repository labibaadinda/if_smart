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
                                    <b> Rekap Mahasiswa {{ $title }} Informatika Fakultas Sains dan Matematika
                                        UNDIP Semarang</b>
                                </th>
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
                                {{-- @php
                                    $i = 0;
                                    foreach (range($thnmin->angkatan, $thnmax->angkatan) as $item)
                                        $i++;
                                    $i=$i*2
                                @endphp --}}
                                <td style="width: 20px;background-color: #a9a9a99c;font-size: 15px;" class="pertama"
                                    colspan=""><b>No</b></td>
                                <td style="width: 150px;background-color: #a9a9a99c;font-size: 15px;" class="pertama"
                                    colspan=""><b>NIM</b></td>
                                <td style="width: 200px;background-color: #a9a9a99c;font-size: 15px;" class="pertama"
                                colspan=""><b>Nama</b></td>
                                <td style="width: 50px;background-color: #a9a9a99c;font-size: 15px;" class="pertama"
                                    colspan=""><b>Angkatan</b></td>
                                {{-- <td style="width: 30px;background-color: #a9a9a99c;font-size: 15px;" class="pertama"
                                    colspan=""><b>Status</b></td>
                                <td style="width: 30px;background-color: #a9a9a99c;font-size: 15px;" class="pertama"
                                    colspan=""><b>Dosen Wali</b></td> --}}
                                @if ($detail === 'sudah')
                                    <td style="width: 50px;background-color: #a9a9a99c;font-size: 15px;" class="pertama"
                                    colspan=""><b>Nilai</b></td>
                                @endif
                                <td></td>
                            </tr>
                            {{-- <tr style="text-align: center;height: 30px;">
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

                            </tr> --}}
                        </thead>
                        <tbody style="font-size: 12px;margin: 0;padding: 0;font-family: 'Times New Roman'!important;">
                            @forelse ($datas as $data)
                                <tr>
                                    <td></td>
                                    <td style="width: 20px;text-align: center;vertical-align: top;" class="kedua">{{ $loop->index + 1 }}</td>
                                    <td style="width: 150px;text-align: center;vertical-align: top;" class="kedua">{{ $data->nim }}</td>
                                    <td style="width: 200px;text-align: start;vertical-align: top;" class="kedua">{{ $data->nama }}</td>
                                    <td style="width: 50px;text-align: center;vertical-align: top;" class="kedua">{{ $data->angkatan }}</td>
                                    @if ($detail === 'sudah')
                                        <td style="width: 50px;text-align: center;vertical-align: top;" class="kedua">{{ $data->nilai }}</td>
                                    @endif
                                    <td></td>
                                </tr>
                            @empty
                                <tr>
                                    <td></td>
                                    <td colspan="5" style="text-align: center;vertical-align: top;"><h4 class="text-center kedua">Tidak Ada Data</h4></td>
                                    <td colspan="1"></td>
                                </tr>
                            @endforelse
                            {{-- <tr>
                                <td></td>
                                <td style="width: 50px;text-align: center;vertical-align: top;" class="kedua">1</td>
                                <td style="width: 50px;text-align: center;vertical-align: top;" class="kedua">PAIK6101</td>
                                <td style="width: 450px;padding-left: 10px;vertical-align: top;" class="kedua" colspan="3">
                                  MATEMATIKA I
                                </td>

                                <td style="width: 50px;text-align: center;vertical-align: top;" class="kedua">2</td>
                                <td style="width: 50px;text-align: center;vertical-align: top;" class="kedua">C</td>
                                <td></td>
                                <td style="width: 50px;text-align: center;vertical-align: top;" class="kedua">24</td>
                                <td style="width: 50px;text-align: center;vertical-align: top;" class="kedua">PAIK6702</td>
                                <td style="width: 450px;padding-left: 10px;vertical-align: top;" class="kedua" colspan="3">
                                  TEORI BAHASA DAN OTOMATA                                      </td><td style="width: 50px;text-align: center;vertical-align: top;" class="kedua">3</td>
                                  <td style="width: 50px;text-align: center;vertical-align: top;" class="kedua">A</td>
                                  <td></td>
                            </tr> --}}

                        </tbody>
                    </table>

                </td>
            </tr>
        </tbody>
    </table>


</body>
