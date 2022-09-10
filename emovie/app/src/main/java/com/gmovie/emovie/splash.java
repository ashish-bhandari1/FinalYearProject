package com.gmovie.emovie;

import androidx.appcompat.app.AppCompatActivity;

import android.content.Intent;
import android.os.Bundle;
import android.util.Log;

import static java.lang.Thread.sleep;

public class splash extends AppCompatActivity {


    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_splash);

        Thread myThread = new Thread(new Runnable() {
            @Override
            public void run() {
                try {
                    sleep(2000);
                    Intent i = new Intent(splash.this , MainActivity.class);
                    startActivity(i);
                }
                catch (InterruptedException e) {
                    Log.e("ss", e.getLocalizedMessage());
                }
            }
        });
        myThread.start();
    }
}
