@extends('layouts.email-template')

@section('email-content')
<!-- Email Body -->
<tr>
    <td class="body" width="100%" cellpadding="0" cellspacing="0" style="font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Helvetica, Arial, sans-serif, 'Apple Color Emoji', 'Segoe UI Emoji', 'Segoe UI Symbol'; box-sizing: border-box; background-color: #ffffff; border-bottom: 1px solid #edeff2; border-top: 1px solid #edeff2; margin: 0; padding: 0; width: 100%; -premailer-cellpadding: 0; -premailer-cellspacing: 0; -premailer-width: 100%;">
        <table class="inner-body" align="center" width="570" cellpadding="0" cellspacing="0" role="presentation" style="font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Helvetica, Arial, sans-serif, 'Apple Color Emoji', 'Segoe UI Emoji', 'Segoe UI Symbol'; box-sizing: border-box; background-color: #ffffff; margin: 0 auto; padding: 0; width: 570px; -premailer-cellpadding: 0; -premailer-cellspacing: 0; -premailer-width: 570px;">

            <!-- Body content -->
            <tr>
                <td class="content-cell" style="font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Helvetica, Arial, sans-serif, 'Apple Color Emoji', 'Segoe UI Emoji', 'Segoe UI Symbol'; box-sizing: border-box; padding: 35px;">
                    <div style="font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Helvetica, Arial, sans-serif, 'Apple Color Emoji', 'Segoe UI Emoji', 'Segoe UI Symbol'; box-sizing: border-box; text-align: center; margin-bottom: 44px;">
                        <h1 style="font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Helvetica, Arial, sans-serif, 'Apple Color Emoji', 'Segoe UI Emoji', 'Segoe UI Symbol'; box-sizing: border-box; color: #3d4852; font-size: 19px; font-weight: bold; margin-top: 0; text-align: left;">
                            Recuperar senha
                        </h1>
                    </div>

                    <div style="font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Helvetica, Arial, sans-serif, 'Apple Color Emoji', 'Segoe UI Emoji', 'Segoe UI Symbol'; box-sizing: border-box; text-align: left;">
                        Ol??, <br>
                        Para recuperar a senha ?? necess??rio clicar no bot??o abaixo.
                    </div>

                    <div style="font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Helvetica, Arial, sans-serif, 'Apple Color Emoji', 'Segoe UI Emoji', 'Segoe UI Symbol'; box-sizing: border-box; text-align: center; margin-top: 44px;">
                        <a style="font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Helvetica, Arial, sans-serif, 'Apple Color Emoji', 'Segoe UI Emoji', 'Segoe UI Symbol'; box-sizing: border-box; color: #4154f1; text-decoration: none; width: 314px; height: 54px; padding: 16px 38px 15px 39px; border-radius: 27px; background-color: #4154f1;" href="{{ $details['url'] }}">
                            <span style="font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Helvetica, Arial, sans-serif, 'Apple Color Emoji', 'Segoe UI Emoji', 'Segoe UI Symbol'; box-sizing: border-box; color: white; font-weight: bold;">
                                Recuperar senha
                            </span>
                        </a>
                    </div>
                </td>
            </tr>
        </table>
    </td>
</tr>
<!-- End Email Body -->
@endsection