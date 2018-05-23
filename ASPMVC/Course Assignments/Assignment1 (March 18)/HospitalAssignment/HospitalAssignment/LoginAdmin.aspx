<%@ Page Title="" Language="C#" MasterPageFile="~/Assignment.Master" AutoEventWireup="true" CodeBehind="LoginAdmin.aspx.cs" Inherits="HospitalAssignment.WebForm2" %>
<%-- Content page for the master --%>

<asp:Content ID="Content1" ContentPlaceHolderID="head" runat="server">
</asp:Content>

<asp:Content ID="Content2" ContentPlaceHolderID="ContentPlaceHolder1" runat="server">
    <div class="well col-xs-6 col-xs-offset-3">
        <h3 class="text-center time-font">ADMIN LOGIN</h3>
        <div class="form-group">
            <label for="txtAdminUser" class="time-font">Username:</label>
            <asp:TextBox ID="txtAdminUser" class="form-control" runat="server"></asp:TextBox>
        </div>
        <div class="form-group">
            <label for="txtAdminPassword" class="time-font">Password:</label>
            <asp:TextBox ID="txtAdminPassword" class="form-control" runat="server" TextMode="Password"></asp:TextBox>
        </div>
        <asp:Button ID="btnAdminLogin" runat="server" CssClass="btn btn-primary btn-block time-font" Text="ADMIN LOGIN" OnClick="btnAdminLogin_Click" />
        <asp:Label ID="lblErrorMessage" runat="server" Text=" "></asp:Label>

    </div>
</asp:Content>
