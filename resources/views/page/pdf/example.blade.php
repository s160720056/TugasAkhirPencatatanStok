<html>
    <head>
        <title>Cetak Nota</title>
        <style>
            @page { margin: 0 }
            body { margin: 0; font-size: 10px; font-family: monospace; }
            td { font-size: 10px; }
            .sheet {
                margin: 0;
                overflow: hidden;
                position: relative;
                box-sizing: border-box;
                page-break-after: always;
            }

            body.struk .sheet { width: {{ $pengaturan->lebar_kertas_struk }}mm; padding: 2mm; }

            .txt-left { text-align: left; }
            .txt-center { text-align: center; }
            .txt-right { text-align: right; }

            @media print {
                body { font-family: monospace; }
                body.struk { width: 58mm; text-align: left; }
                body.struk .sheet { padding: 2mm; }
            }
        </style>
    </head>
    <body class="struk" onload="printOut()">
        <section class="sheet">
            <!-- Header with company information -->
            <table cellpadding="0" cellspacing="0" style="width:100%; text-align:center">
                <tr><td><h1>SV MOTOR</h1></td></tr>
                <tr><td>JL MEDANJDNJSNJF</td></tr>
                <tr><td>Telp: 0123456789</td></tr>
            </table>

            <hr/>

            <!-- Invoice and Customer Information -->
            <table cellpadding="0" cellspacing="0" style="width: 100%">
                <tr>
                    <td class="txt-left">Nota&nbsp;</td>
                    <td class="txt-left">:</td>
                    <td class="txt-left">&nbsp;INV12345678</td>
                </tr>
                <tr>
                    <td class="txt-left">Kasir</td>
                    <td class="txt-left">:</td>
                    <td class="txt-left">&nbsp;John Doe</td>
                </tr>
                <tr>
                    <td class="txt-left">Tgl.&nbsp;</td>
                    <td class="txt-left">:</td>
                    <td class="txt-left">&nbsp;11-10-2024 10:00:00</td>
                </tr>
                <tr>
                    <td class="txt-left" colspan="3">[CUST1234] Jane Doe</td>
                </tr>
            </table>

            <br/>

            <!-- Item Details -->
            <table cellpadding="0" cellspacing="0" style="width: 100%">
                <!-- Table header for items -->
                <tr>
                    <th class="txt-left">Item</th>
                    <th class="txt-center">Qty</th>
                    <th class="txt-right">Harga</th>
                    <th class="txt-right">Total</th>
                </tr>
                <tr><td colspan="4"><hr></td></tr>
            
                <!-- Item 1 -->
                <tr>
                    <td class="txt-left">Item 1</td>
                    <td class="txt-center">1</td>
                    <td class="txt-right">10.000</td>
                    <td class="txt-right">10.000</td>
                </tr>
            
                <!-- Item 2 -->
                <tr>
                    <td class="txt-left">Item 2</td>
                    <td class="txt-center">2</td>
                    <td class="txt-right">15.000</td>
                    <td class="txt-right">30.000</td>
                </tr>
            
                <tr><td colspan="4"><hr></td></tr>
            
                <!-- Sub Total -->
                <tr>
                    <td colspan="3" class="txt-right">Sub Total:</td>
                    <td class="txt-right">40.000</td>
                </tr>
            
                <!-- Discount -->
                <tr>
                    <td colspan="3" class="txt-right">Diskon:</td>
                    <td class="txt-right">5.000</td>
                </tr>
            
                <!-- PPN -->
                <tr>
                    <td colspan="3" class="txt-right">PPN(11%):</td>
                    <td class="txt-right">3.500</td>
                </tr>
            
                <!-- Grand Total -->
                <tr>
                    <td colspan="3" class="txt-right">Grand Total:</td>
                    <td class="txt-right">38.500</td>
                </tr>
            
                <tr><td colspan="4"><hr></td></tr>
            
                <!-- Payment -->
                <tr>
                    <td colspan="3" class="txt-right">BAYAR:</td>
                    <td class="txt-right">50.000</td>
                </tr>
            
                <!-- Change -->
                <tr>
                    <td colspan="3" class="txt-right">KEMBALI:</td>
                    <td class="txt-right">11.500</td>
                </tr>
            </table>
            
            <br/>
            <p class="txt-center"><strong>* Terima kasih atas kunjungan Anda *</strong></p>
        </section>
    </body>
</html>

<script>
    var lama = 1000;
    var t = null;
    function printOut() {
        window.print();
        t = setTimeout("self.close()", lama);
    }
</script>
