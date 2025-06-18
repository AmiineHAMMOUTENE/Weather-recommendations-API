// src/components/ui/calendar.jsx
import * as React from "react";
import { useState } from "react";
import { DayPicker } from "react-day-picker";
import "react-day-picker/dist/style.css";

export function Calendar({ value, onChange }) {
  return (
    <div className="rounded-md border p-2">
      <DayPicker 
        mode="single" 
        selected={value} 
        onSelect={onChange} 
      />
    </div>
  );
}
