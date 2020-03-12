package com.example.daoyunapp;

import androidx.appcompat.app.AppCompatActivity;

import android.content.Intent;
import android.os.Bundle;

public class LauncherActivity extends AppCompatActivity {

    @Override
    protected void onCreate ( Bundle savedInstanceState ) {
        super.onCreate (savedInstanceState);
        new Thread( new Runnable( ) {
            @Override
            public void run() {
                try {
                    wait(1000);
                    startActivity(new Intent (LauncherActivity.this, MainActivity.class));
                    finish();//关闭当前活动
                }catch (Exception e){
                    e.printStackTrace ();
                }
            }
        } ).start();
    }
}
