<%@ Page Title="" Language="C#" MasterPageFile="~/Assignment.Master" AutoEventWireup="true" CodeBehind="Login.aspx.cs" Inherits="HospitalAssignment.WebForm1" %>

<%--This is the login page, meant for patients and doctors--%>

<asp:Content ID="Content1" ContentPlaceHolderID="head" runat="server">
</asp:Content>
<asp:Content ID="Content2" ContentPlaceHolderID="ContentPlaceHolder1" runat="server">
    <div class="well col-xs-6 col-xs-offset-3">
        <h3 class="text-center time-font">LOGIN</h3>

        <div class="form-group">
            <label for="txtUser" class="time-font">Username:</label>
            <br />
            <asp:TextBox ID="txtUser" class="form-control" runat="server"></asp:TextBox>
        </div>

        <div class="form-group">
            <label for="txtpass" class="time-font">Password:</label>
            <asp:TextBox ID="txtpass" class="form-control" runat="server" TextMode="Password"></asp:TextBox>
        </div>
        <asp:Button ID="btnLogin" runat="server" CssClass="btn btn-primary btn-block time-font" Text="LOGIN" OnClick="btnLogin_Click" />
        <asp:Label ID="lblErrorMessage" runat="server" Text=" "></asp:Label>
    </div>
</asp:Content>
