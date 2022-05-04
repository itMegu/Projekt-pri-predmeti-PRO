from flask import Flask,redirect, render_template,url_for,request
app = Flask(__name__)

@app.route('/sucsess')
def uspeh(name):
    return render_template("popup.html")