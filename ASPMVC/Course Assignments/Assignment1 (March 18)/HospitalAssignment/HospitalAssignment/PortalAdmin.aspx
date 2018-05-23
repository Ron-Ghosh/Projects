<%@ Page Language="C#" AutoEventWireup="true" CodeBehind="PortalAdmin.aspx.cs" Inherits="HospitalAssignment.PortalAdmin" %>

<!DOCTYPE html>

<html xmlns="http://www.w3.org/1999/xhtml">
<head runat="server">
    <title>Admin Portal</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

    <style>
        .background {
            background-image: url("http://www.hok.com/uploads/2016/02/25/shanghai-hospital01.jpg");
            background-size: 100%;
        }

        .responsive-textbox {
            width: 100%;
        }

        .time-font {
            font-family: "Times New Roman", Times, serif;
        }
    </style>
</head>
<body class="background">
    <form id="form1" runat="server">
        <div class="container">
            <div class="row">
                <div class="col-xs-8 col-xs-offset-2">
                    <div class="well">
                        <asp:Button ID="btnBack"  CssClass="btn btn-default"  runat="server" Text="Back" OnClick="btnBack_Click" /> <br /><br />

                        <table class="table">
                            <thead>
                                <tr>
                                    <th class="time-font text-center">ID </th>
                                    <th class="time-font text-center">Name </th>
                                    <th class="time-font text-center">Password</th>
                                    <th class="time-font text-center">Privilege</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>
                                        <asp:TextBox ID="txtId" CssClass="responsive-textbox" runat="server"></asp:TextBox></td>
                                    <td>
                                        <asp:TextBox ID="txtName" CssClass="responsive-textbox" runat="server"></asp:TextBox></td>
                                    <td>
                                        <asp:TextBox ID="txtPass" CssClass="responsive-textbox" runat="server"></asp:TextBox></td>
                                    <td>
                                        <asp:TextBox ID="txtPrivilege" CssClass="responsive-textbox" runat="server"></asp:TextBox>
                                </tr>
                            </tbody>
                        </table>
                        <asp:Label ID="lblRecord" runat="server" Text=""></asp:Label>
                        <asp:Button ID="btnLoadInfo" CssClass="btn btn-primary btn-block" runat="server" Text="Load" OnClick="btnLoadInfo_Click" />
                        <asp:Button ID="btnUpdate" CssClass="btn btn-primary btn-block" runat="server" Text="Update" OnClick="btnUpdate_Click" />
                        <asp:Button ID="btnInsert" CssClass="btn btn-primary btn-block" runat="server" Text="Insert" OnClick="btnInsert_Click"  />
                        <asp:Button ID="btnDelete" CssClass="btn btn-primary btn-block" runat="server" Text="Delete" OnClick="btnDelete_Click" />

                    </div>
                </div>
            </div>
        </div>
    </form>
</body>
</html>
